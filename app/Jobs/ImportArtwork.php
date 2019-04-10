<?php

namespace App\Jobs;

use App\Artwork;
use App\Artist;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ImportArtwork implements ShouldQueue
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $json = json_decode(file_get_contents(sprintf($this->urlFormat,
            '2980db3a-9eb4-4c0e-b7c6-a6584cb769c9',
            '18705524-c8a6-49a0-bca7-92f493e6d329')));
        $this->progressBar->setMaxSteps(count($json));

        $this->progressBar->start();
        foreach ($json as $artwork) {
            $this->normalize($artwork);

            $title = $artwork->Titre;

            if ($artwork->DateFinProduction) {
                preg_match('/(-?\d+)(\d{3})([+-]\d{4})/',
                    $artwork->DateFinProduction, $matches);
                $produced_at = date_create_from_format('UO',
                    $matches[1] . $matches[3]);
            }

            $category = Artwork\Category::firstOrCreate(
                ['fr' => $artwork->CategorieObjet],
                ['en' => $artwork->CategorieObjetAng]
            );

            $subcategory = Artwork\Subcategory::firstOrCreate(
                ['fr' => $artwork->SousCategorieObjet],
                ['en' => $artwork->SousCategorieObjetAng]
            );

            $dimensions = array_filter($artwork->DimensionsGenerales);

            $borough = Artwork\Borough::firstOrCreate(
                ['name' => $artwork->Arrondissement]
            );

            $location = new Point($artwork->CoordonneeLatitude,
                $artwork->CoordonneeLongitude);

            $model = Artwork::updateOrCreate(
                ['title' => $title, 'location' => $location],
                ['produced_at' => $produced_at, 'dimensions' => $dimensions,
                 'borough_id' => $borough->id, 'category_id' => $category->id,
                 'subcategory_id' => $subcategory->id]
            );

            /* Artists */
            foreach ($artwork->Artistes as $artist) {
                if ($collective = isset($artist->NomCollectif)) {
                    $name = $artist->NomCollectif;
                } else {
                    $name = $artist->Prenom . ' ' . $artist->Nom;
                }

                $model->artists()->syncWithoutDetaching(Artist::updateOrCreate(
                    ['name' => $name], ['collective' => $collective]
                )->id);
            }

            /* Materials */
            foreach ($this->array_zip($artwork->Materiaux,
                $artwork->MateriauxAng) as $material) {
                /* XXX */
                $material[0] = $this->mb_ucfirst(trim($material[0]));
                $material[1] = $this->mb_ucfirst(trim($material[1]));

                /* XXX */
                if ($material[0] == 'Béton ductal') {
                    $material[1] = 'Ductal concrete';
                } else if ($material[0] == 'Aluminium') {
                    $material[1] = 'Aluminum';
                } else if ($material[0] == 'DEL') {
                    $material[1] = 'LED';
                } else if ($material[0] == 'Corten') {
                    $material[1] = 'Corten';
                } else if ($material[0] == 'Composantes technologiques') {
                    $material[1] = 'Technological components';
                } else if ($material[0] == 'Granit') {
                    $material[1] = 'Granit';
                }

                /* XXX */
                if ($material[0] != '') {
                    $model->materials()->syncWithoutDetaching(Artwork\Material::updateOrCreate(
                        ['fr' => $material[0]], ['en' => $material[1]]
                    )->id);
                }
            }

            /* Techniques */
            foreach ($this->array_zip($artwork->Technique,
                $artwork->TechniqueAng) as $technique) {
                /* XXX */
                $technique[0] = $this->mb_ucfirst(trim($technique[0]));
                $technique[1] = $this->mb_ucfirst(trim($technique[1]));

                /* XXX */
                if ($technique[0] == 'Aluchromie') {
                    $technique[1] = 'Aluchromy';
                } else if ($technique[0] == 'Contre-collé sur bois') {
                    $technique[1] = 'Laminated on wood';
                } else if ($technique[0] == 'Tourné') {
                    $technique[1] = 'Turned';
                } else if ($technique[0] == 'Béton coulé (stèles)') {
                    $technique[1] = 'Poured concrete (stelae)';
                } else if ($technique[0] == 'Aluminium taillé') {
                    $technique[1] = 'Cut aluminum';
                } else if ($technique[0] == 'Soudé') {
                    $technique[1] = 'Welded';
                } else if ($technique[0] == 'Laminé') {
                    $technique[1] = 'Laminated';
                } else if ($technique[0] == 'Pulvérisé') {
                    $technique[1] = 'Pulverised';
                } else if ($technique[0] == 'Soudées ensemble') {
                    $technique[1] = 'Welded together';
                } else if ($technique[0] == 'Granit poli') {
                    $technique[1] = 'Polished granite';
                } else if ($technique[0] == 'Assemblé Granit: gravé au jet de sable (fabrication artisanale)') {
                    $technique[1] = 'Assembled Granite: sandblasted (handcrafted)';
                } else if ($technique[0] == 'Vidéoprojections (oeuvre numérique)') {
                    $technique[1] = 'Videoprojections (digital work)';
                } else if ($technique[0] == 'Pavés découpés') {
                    $technique[1] = 'Cut pavers';
                }

                /* XXX */
                if ($technique[0] != '') {
                    $model->techniques()->syncWithoutDetaching(Artwork\Technique::updateOrCreate(
                        ['fr' => $technique[0]], ['en' => $technique[1]]
                    )->id);
                }
            }

            $this->progressBar->advance();
        }
        $this->progressBar->finish();
    }

    /**
     * Normalize the data.
     *
     * @param  object  $artwork
     * @return void
     */
    public function normalize($artwork)
    {
        /* Sous-catégorie */
        if ($artwork->SousCategorieObjet == 'Bois/menuiserie d\'art') {
            $artwork->SousCategorieObjet = 'Bois/Menuiserie';
        } else if ($artwork->SousCategorieObjet == 'Design industriel') {
            $artwork->SousCategorieObjet = 'Design Industriel';
        } else if ($artwork->SousCategorieObjet == 'Mosaique') {
            $artwork->SousCategorieObjet = 'Mosaïque';
        } else if ($artwork->SousCategorieObjet == 'Techniques mixtes') {
            $artwork->SousCategorieObjet = 'Technique Mixte';
        }

        /* XXX */
        $split = '/x++(?!cm|m)|(?<=\d|x)(?=cm|m)|(?<=cm|m)(?=\d)/i';
        $replace = '/\(.*?\)|\s+|\'|:|(?<!\d)\.|(?!c?m)[a-œ]+(?<!x|\\r)/i';
        $artwork->DimensionsGenerales = preg_split($split,
            preg_replace('/,/', '.', preg_replace($replace, '',
            $artwork->DimensionsGenerales)));

        /* XXX */
        $split = '/;|,| (et|ou|and|or) (?!.*\))/';
        $replace = '/\.|\?|\(.*?\)/';
        $artwork->Materiaux = preg_split($split, preg_replace($replace, '',
            $artwork->Materiaux));
        $artwork->MateriauxAng = preg_split($split, preg_replace($replace, '',
            $artwork->MateriauxAng));

        /* XXX */
        $split = '/;|,| (et|ou|and|or) (?!.*\))/';
        $replace = '/\.|\(\?\)/';
        $artwork->Technique = preg_split($split, preg_replace($replace, '',
            $artwork->Technique));
        $artwork->TechniqueAng = preg_split($split, preg_replace($replace, '',
            $artwork->TechniqueAng));
    }

    /**
     * Constructs an array of arrays.
     *
     * @param  array  ...$arrays
     * @return array
     */
    function array_zip(...$arrays)
    {
        return array_map(null, ...$arrays);
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
