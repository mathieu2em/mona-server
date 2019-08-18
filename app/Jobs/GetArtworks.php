<?php

namespace App\Jobs;

use App\Artwork;
use App\Artist;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Foundation\Bus\Dispatchable;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\DomCrawler\Crawler;

class GetArtworks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $progressBar;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->progressBar = new ProgressBar(new ConsoleOutput());
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = 'https://artpublicmontreal.ca/wp-admin/admin-ajax.php';

        $data = array(
            'action' => 'apm_more_artworks',
            'post_type' => 'apm_artwork',
            'post_status' => 'publish',
            'apm_random' => '0',
        );

        $options = array(
            'http' => array(
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'method'  => 'POST',
            )
        );

        $this->progressBar->setMaxSteps(36 * 25);
        $this->progressBar->start();
        foreach (range(1, 36) as $page) {
            $data['paged'] = $page;
            $options['http']['content'] = http_build_query($data);

            $crawler = new Crawler(file_get_contents($url, false,
                stream_context_create($options)));
            $links = $crawler->filterXPath("//a[contains(@class, 'artwork-thumb')]")->extract('href');
            foreach ($links as $link) {
                try {
                    $crawler = new Crawler(file_get_contents($link."?apm_ajax=1"));
                } catch (ErrorException $e) {
                    echo $e->getMessage();
                    $this->progressBar->advance();
                    continue;
                }
                $json = json_decode($crawler->filterXPath("//div[contains(@class, 'ap-data')]")->text());

                $lat = $json->mapMarkers[0]->loc->lat;
                $long = $json->mapMarkers[0]->loc->long;
                if ($lat == 0 || $long == 0) {
                    $this->progressBar->advance();
                    continue;
                }
                $location = new Point($lat, $long);

                $title = $crawler->filterXPath("//div[contains(@class, 'apm-title-xl')]")->text();

                $year = $crawler->filterXPath("//div[contains(@class, 'apm-ArtworkDate')]");
                $produced_at = null;
                if ($year->count()) {
                    $year = trim($year->text());
                    $produced_at = date_create_from_format('Y-m-d', "$year-01-01"); // XXX
                }

                $category = null;
                $subcategory = null;
                $categorie = $crawler->filterXPath("//div[contains(@class, 'detail-categorie')]/strong");
                if ($categorie->count()) {
                    $categorie = $this->mb_ucfirst(trim(explode(", ", $categorie->text())[0]));
                    if ($categorie == "Sculpture suspendue cinétique") {
                        $categorie = "Sculpture";
                    }
                    if ($categorie == "Techniques mixtes") {
                        $categorie = "Technique Mixte";
                    }

                    if ($categorie == "Murale") {
                        $category = Artwork\Category::where(
                            'fr', "Murales"
                        )->first()->id;
                    }

                    $subcategory = Artwork\Subcategory::where(
                        'fr', $categorie
                    )->first();
                    if ($subcategory) {
                        $subcategory = $subcategory->id;
                        if (!$category) {
                            if (in_array($subcategory, [5, 8, 9, 10, 11, 12])) {
                                $category = 1;
                            } else if (in_array($subcategory, [2, 6, 7, 13, 14, 15])) {
                                $category = 2;
                            }
                        }
                    }
                }

                $dimensions = [];
                $dims = $crawler->filterXPath("//div[contains(@class, 'detail-dimensions-generales')]/strong");
                if ($dims->count()) {
                    $split = '/x++(?!cm|m)|(?<=\d|x)(?=cm|m)|(?<=cm|m)(?=\d)|(?<=cm|m)\/|;/i';
                    $replace = '/\(.*?\)|\s+|:|(?<!\d)\.|(?!c?m)[a-œ]+(?<!x|\\r)/i';
                    $dimensions = preg_split($split,
                        preg_replace('/,/', '.', preg_replace($replace, '',
                        $dims->text())));
                }

                $borough = null;
                $arrondissement = $crawler->filterXPath("//div[contains(@class, 'detail-arrondissement-ou-ville-liee')]/strong");
                if ($arrondissement->count()) {
                    $borough = Artwork\Borough::where(
                        'name', trim($arrondissement->text())
                    )->first();
                    if ($borough) {
                        $borough = $borough->id;
                    }
                }

                $collection = null;
                $proprietaire = $crawler->filterXPath("//div[contains(@class, 'detail-proprietaire')]/strong");
                if ($proprietaire->count()) {
                    $proprietaire = trim($proprietaire->text());
                    if ($proprietaire == "Ville de Montréal") {
                        $proprietaire = "Bureau d'art public, Ville de Montréal";
                    }

                    $collection = Artwork\Collection::where(
                        'name', $proprietaire
                    )->first();
                    if ($collection) {
                        $collection = $collection->id;
                    }
                }

                $details = $crawler->filterXPath("//div[contains(@class, 'detail-localisation')]/strong");
                $details = $details->count() ? trim($details->text()) : "";

                try {
                    $model = Artwork::updateOrCreate(
                        ['title' => $title, 'borough_id' => $borough],
                        ['location' => $location, 'dimensions' => $dimensions,
                         'category_id' => $category, 'subcategory_id' => $subcategory,
                         'produced_at' => $produced_at, 'details' => $details,
                         'collection_id' => $collection]
                    );
                } catch (JsonEncodingException $e) {
                }

                $techniques = $crawler->filterXPath("//div[contains(@class, 'detail-techniques')]/strong");
                if ($techniques->count()) {
                    $techniques = preg_split('/, /', $techniques->text());
                    foreach ($techniques as $technique) {
                        $technique = $this->mb_ucfirst(trim($technique));
                        $model->techniques()->syncWithoutDetaching(Artwork\Technique::firstOrCreate( // XXX
                            ['fr' => $technique], ['en' => '']
                        )->id);
                    }
                }

                $artists = [];
                $artist_data = $crawler->filterXPath("//div[contains(@class, 'apm-ArtworkArtist-name')]");
                if ($artist_data->count()) {
                    if (($artist_data = trim($artist_data->text()))) {
                        $artists = preg_split('/, | & | et /', preg_replace('/\(.*?\)/', '', $artist_data));
                        foreach ($artists as $artist) {
                            $artist = trim($artist);
                            if ($artist == "In Situ | Atelier d'architecture") {
                                $artist == "In Situ";
                            }
                            $model->artists()->syncWithoutDetaching(Artist::firstOrCreate( // XXX
                                ['name' => $artist],
                            )->id);
                        }
                    }
                }

                $this->progressBar->advance();
            }
        }
        $this->progressBar->finish();
    }

    /**
     * Make a string's first character uppercase.
     *
     * @param  string  $str
     * @return string
     */
    public function mb_ucfirst($str)
    {
        return mb_strtoupper(mb_substr($str, 0, 1)).mb_substr($str, 1);
    }
}
