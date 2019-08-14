<?php

namespace App\Jobs;

use App\Artwork;
use App\Artist;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ImportCollection implements ShouldQueue
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
     * TODO.
     *
     * @return void
     */
    public function handleUdeM()
    {
        $csv = array_map('str_getcsv', array_slice(explode(PHP_EOL,
            Storage::get('private/UdeM.csv')), 1, -1));
        $this->progressBar->setMaxSteps(count($csv));

        $collection = Artwork\Collection::where(
            'name', 'Université de Montréal'
        )->first();

        $this->progressBar->start();
        foreach ($csv as $artwork) {
            $title = $artwork[0];

            $produced_at = date_create_from_format('Y-m-d', "$artwork[6]-01-01"); // XXX

            $category = Artwork\Category::where(
                'fr', $artwork[2]
            )->first();

            $subcategory = Artwork\Subcategory::where(
                'fr', $artwork[4]
            )->first();

            $dimensions = array_filter(explode(" x ", $artwork[9]));

            $location = new Point($artwork[11], $artwork[12]);

            $borough = Artwork\Borough::contains('area', $location)->first();

            $details = $artwork[13];

            $model = Artwork::updateOrCreate(
                ['title' => $title, 'borough_id' => $borough->id],
                ['location' => $location, 'dimensions' => $dimensions,
                 'category_id' => $category->id, 'subcategory_id' => $subcategory->id,
                 'produced_at' => $produced_at, 'collection_id' => $collection->id,
                 'details' => $details]
            );

            $model->artists()->syncWithoutDetaching(Artist::firstOrCreate( // XXX
                ['name' => trim($artwork[14]) . " " . trim($artwork[15])]
            )->id);

            $techniques = explode('; ', $artwork[8]);
            foreach ($techniques as $technique) {
                if ($technique == "mosaïque") {
                    continue;
                }

                if ($technique = ucfirst($technique)) {
                    $model->techniques()->syncWithoutDetaching(Artwork\Technique::firstOrCreate( // XXX
                        ['fr' => $technique],
                    )->id);
                }
            }

            $materials = preg_split('/; | et /', preg_replace('/[A-zÀ-ú]+: |\?/', '', $artwork[7]));
            foreach ($materials as $material) {
                if ($material == "synthétiques") {
                    $material = "Fibres synthétiques";
                } else if ($material == "émail") {
                    $material = "Émail";
                }

                if ($material = ucfirst($material)) {
                    $material_en = null;
                    if ($material == "Patine") {
                        $material_en = "Patina";
                    } else if ($material == "Aggloméré") {
                        $material_en = "Agglomerate";
                    } else if ($material == "Formica") {
                        $material_en = "Formica";
                    } else if ($material == "Fibres naturelles") {
                        $material_en = "Natural fibers";
                    } else if ($material == "Fibres synthétiques") {
                        $material_en = "Synthetic fibers";
                    } else if ($material == "Polyuréthane") {
                        $material_en = "Polyurethane";
                    } else if ($material == "Peinture électrostatique") {
                        $material_en = "Electrostatic painting";
                    } else if ($material == "Poudre d’oxyde colorée") {
                        $material_en = "Colored oxide powder";
                    } else if ($material == "Contreplaqué") {
                        $material_en = "Plywood";
                    }

                    if ($material_en) {
                        $model->materials()->syncWithoutDetaching(Artwork\Material::updateOrCreate( // XXX
                            ['fr' => $material], ['en' => $material_en]
                        )->id);
                    } else {
                        $model->materials()->syncWithoutDetaching(Artwork\Material::firstOrCreate( // XXX
                            ['fr' => $material],
                        )->id);
                    }
                }
            }

            $this->progressBar->advance();
        }
        $this->progressBar->finish();
    }

    /**
     * TODO.
     *
     * @return void
     */
    public function handleMU()
    {
        $csv = array_map('str_getcsv', array_slice(explode(PHP_EOL,
            Storage::get('private/MU.csv')), 1, -1));
        $this->progressBar->setMaxSteps(count($csv));

        $category = Artwork\Category::where('fr', 'Murales')->first();
        $collection = Artwork\Collection::where(
            'name', 'MU'
        )->first();

        $this->progressBar->start();
        foreach ($csv as $artwork) {
            if ($artwork[3] == "Ottawa" ||
                $artwork[3] == "Québec" ||
                $artwork[3] == "Mont-Tremblant") {
                continue;
            }

            $title = trim(str_replace('"', '', $artwork[0]));

            $produced_at = date_create_from_format('Y-m-d', "$artwork[1]-01-01"); // XXX

            /* XXX */
            if ($artwork[4] == "Côtes-des-Neiges-NDG") {
                $artwork[4] = "Côte-des-Neiges–Notre-Dame-de-Grâce";
            } else if ($artwork[4] == "Mercier-Hochelaga-Maisonneuve") {
                $artwork[4] = "Mercier–Hochelaga-Maisonneuve";
            } else if ($artwork[4] = "Rosemont-La-Petite-Patrie") {
                $artwork[4] = "Rosemont–La Petite-Patrie";
            }
            $borough = Artwork\Borough::where(
                'name', $artwork[4]
            )->first();

            $details = preg_replace('/^"|"$/', '', $artwork[6]);

            /* XXX */
            preg_match("/(\d+)\s*°\s*(\d+)\s*'\s*(\d+\.\d+)\s*(\"|'')/", $artwork[11], $lat);
            preg_match("/(\d+)\s*°\s*(\d+)\s*'\s*(\d+\.\d+)\s*(\"|'')/", $artwork[12], $lon);
            $location = new Point(
                $this->DMStoDEC($lat[1], $lat[2], $lat[3]),
                -$this->DMStoDEC($lon[1], $lon[2], $lon[3])
            );

            $model = Artwork::updateOrCreate(
                ['title' => $title, 'borough_id' => $borough->id ?? null],
                ['location' => $location, 'produced_at' => $produced_at,
                 'details' => $details, 'collection_id' => $collection->id,
                 'category_id' => $category->id] // XXX
            );

            /* XXX */
            $artists = preg_split('/,|&|\+| et/', preg_replace('/avec .* de|en .* avec/', ',', $artwork[2]));
            foreach ($artists as $artist) {
                if ($artist == "Other (Troy Lovegates)") {
                    $artist = "Troy Lovegates";
                }
                $artist = ucfirst(trim(preg_replace('/^"|[A-zÀ-ú ]+:|équipe de |\(.*\)|\(|\)/', '', $artist)));
                if ($artist == "Alexa Hatanaka") {
                    continue;
                } else if ($artist == "Embassy of Imagination Patrick Thompson") {
                    $artist = "Embassy of Imagination";
                }

                $model->artists()->syncWithoutDetaching(Artist::firstOrCreate( // XXX
                    ['name' => $artist],
                )->id);
            }

            $this->progressBar->advance();
        }
        $this->progressBar->finish();
    }

    /**
     * TODO.
     *
     * @return void
     */
    public function handleDC()
    {
        $json = json_decode(file_get_contents(
            "https://arcgis.com/sharing/content/items/d03d076d190844ad8a9e17df8727b1eb/data"));
        $artworks = $json->operationalLayers[1]->featureCollection->layers[0]->featureSet->features;
        $this->progressBar->setMaxSteps(count($artworks));

        $collection = Artwork\Collection::where(
            'name', 'Dose Culture'
        )->first();

        $this->progressBar->start();
        foreach ($artworks as $artwork) {
            $artwork = $artwork->attributes;
            if (!isset($artwork->lat) || !isset($artwork->long)) {
                continue;
            }

            preg_match("/(?<='>).*(?=<\/f)/", $artwork->description, $matches);
            $title = $matches[0];

            $location = new Point($artwork->lat, $artwork->long);

            /* XXX */
            $details = preg_replace('/  /', ' - ', trim(preg_replace('/<.*?>/', ' ', $artwork->name)));
            if ($details == "Parc Marquis-de-Montcalm (chalet) - 1555 rue Lavallée &nbsp; -  -  L'artiste sera présent : ....") {
                $details = "Parc Marquis-de-Montcalm (chalet) - 1555 rue Lavallée";
            }

            $model = Artwork::updateOrCreate(
                ['title' => $title, 'borough_id' => null],
                ['location' => $location, 'details' => $details,
                 'collection_id' => $collection->id] // XXX
            );

            preg_match('/(?<=:).*(?=<)/', $artwork->description, $matches);
            $artists = preg_split('/ et |, /', trim(preg_replace('/<.*>/', '', $matches[0])));

            foreach ($artists as $artist) {
                $model->artists()->syncWithoutDetaching(Artist::firstOrCreate( // XXX
                    ['name' => $artist],
                )->id);
            }

            $this->progressBar->advance();
        }
        $this->progressBar->finish();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->handleUdeM();
        $this->handleMU();
        $this->handleDC();
    }


    /**
     * TODO
     *
     * @return TODO
     */
    public function DMStoDEC($deg, $min, $sec)
    {
        return $deg + ($min * 60 + $sec) / 3600;
    }
}
