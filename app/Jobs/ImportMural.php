<?php

namespace App\Jobs;

use App\Artwork;
use App\Artist;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GeoJson\GeoJson;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\MultiPolygon;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ImportMural implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $urlFormat;
    private $progressBar;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->urlFormat = 'http://donnees.ville.montreal.qc.ca/' .
            'dataset/%s/resource/%s/download';

        $this->progressBar = new ProgressBar(new ConsoleOutput());
    }

    /**
     * TODO.
     *
     * @return void
     */
    public function handleBoroughs()
    {
        $json = json_decode(file_get_contents(sprintf($this->urlFormat,
            '00bd85eb-23aa-4669-8f1b-ba9a000e3dd8',
            'e9b0f927-8f75-458c-8fda-b5da65cc8b73')));

        foreach ($json->features as $feature) {
            if ($feature->properties->TYPE == 'Arrondissement') {
                $abbr = $feature->properties->ABREV;
                $area = MultiPolygon::fromJson(GeoJson::jsonUnserialize(
                    $feature->geometry
                ));

                Artwork\Borough::where('abbr', $abbr)->update([
                    'area' => $area,
                ]);
            }
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->handleBoroughs();
        $category = Artwork\Category::where('fr', 'Murales')->first();

        $json = json_decode(file_get_contents(sprintf($this->urlFormat,
            '53d2e586-6e7f-4eae-89a1-2cfa7fc29fa0',
            'd325352b-1c06-4c3a-bf5e-1e4c98e0636b')));
        $this->progressBar->setMaxSteps(count($json->features));

        $this->progressBar->start();
        foreach ($json->features as $feature) {
            $mural = $feature->properties;
            if (strpos($mural->artiste, 'Cette murale') !== false) {
                continue;
            }

            $produced_at = date_create_from_format('Y', $mural->annee);

            $location = new Point($mural->latitude, $mural->longitude);

            $borough = Artwork\Borough::contains('area', $location)->first();

            $model = Artwork::updateOrCreate(
                ['category_id' => $category->id, 'borough_id' => $borough->id],
                ['produced_at' => $produced_at, 'location' => $location]
            );

            $artists = preg_split('/,|:|&| et /i', preg_replace('/\./', '', $mural->artiste));
            if ($artists == ["A'SHOP-ANKHONE"]) {
                $artists = ["AShop", 'Ankh One'];
            } else if ($artists == ['Snikr - Style Over Status']) {
                $artists = ['Snikr', 'Style Over Status'];
            } else if ($artists == ["AShop (Zek", 'Dodo Ose)']) {
                $artists = ["AShop", 'Zek', 'Dodo Ose'];
            }

            foreach ($artists as $artist) {
                $name = $this->normalize($artist);
                if (strpos($name, 'citoyenNes') !== false ||
                    strpos($name, 'les élèves') !== false) {
                    continue;
                }

                $collective = $this->isCollective($name);

                $model->artists()->syncWithoutDetaching(Artist::firstOrCreate( // XXX
                    ['name' => $name], ['collective' => $collective]
                )->id);
            }

            $org = trim(preg_replace('/\(.*?\)/', '', $mural->organisation));
            $model->artists()->syncWithoutDetaching(Artist::updateOrCreate(
                ['name' => $org], ['collective' => true]
            )->id);

            $this->progressBar->advance();
        }
        $this->progressBar->finish();
    }

    /**
     * TODO.
     *
     * @param  string  $artist
     * @return bool
     */
    public function isCollective($artist)
    {
        return $artist == 'Jeunes résidents de Place Normandie' ||
            $artist == "A'Shop" ||
            $artist == 'Collectif Au pied du mur' ||
            $artist == 'Nayan' ||
            $artist == 'Les Hommes de lettres';
    }

    /**
     * TODO.
     *
     * @param  string  $artist
     * @return string
     */
    public function normalize($artist)
    {
        $artist = trim(preg_replace('/\(.*?\)/', '', $artist));
        switch ($artist) {
            case 'NAIMO':
            case 'VHILS':
            case 'PONI':
            case 'FRANCIS MONTILLAUD':
            case 'CYRIELLE TREMBLAY':
            case 'GENE PENDON':
                return ucwords(strtolower($artist));
        }
        return $artist;
    }
}
