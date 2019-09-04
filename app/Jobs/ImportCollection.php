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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->progressBar = new ProgressBar(new ConsoleOutput());

        $this->artists = [
            'Jacques G de Tonnancour' => 'Jacques Godefroy de Tonnancour',
        ];

        $this->techniques = [
            'Mosaïque'         => '',
            'Découpé au laser' => 'Découpe au laser',
        ];

        $this->materials = [
            'Synthétiques'           => 'Fibres synthétiques',
            'émail'                  => 'Émail',
            'Poudre d’oxyde colorée' => 'Poudre d\'oxyde colorée',
        ];

        /* $this->boroughs = [ */
        /*     'Côtes-des-Neiges-NDG'          => 'Côte-des-Neiges–Notre-Dame-de-Grâce', */
        /*     'Mercier-Hochelaga-Maisonneuve' => 'Mercier–Hochelaga-Maisonneuve', */
        /*     'Rosemont-La-Petite-Patrie'     => 'Rosemont–La Petite-Patrie', */
        /* ]; */

        $this->artists = [
            'Arpi'                                    => ['René-Pierre Beaudry', 'Arpi'],
            'Labrona'                                 => ['', 'Labrona'],
            'Huma Design'                             => ['Humà Design'],
            'SETH Julien Malland'                     => ['Julien Malland', 'Seth'],
            'Other Troy Lovegates'                    => ['Troy Lovegates', 'Other'],
            'Julio Cesar Moreno Nicaragua'            => ['Julio Cesar Moreno'],
            'Roadsworth'                              => ['Peter Gibson', 'Roadsworth'],
            'Roadsworth Peter Gibson'                 => ['Peter Gibson', 'Roadsworth'],
            'Monk.e'                                  => ['', 'Monk.E'],
            'Cyril V'                                 => ['Cyril V.', ''],
            'FIVE EIGHT'                              => ['', 'Five8'],
            'XRay'                                    => ['', 'XRay'],
            'Surface 3'                               => [''],
            'Five8'                                   => ['', 'Five8'],
            'OMEN'                                    => ['', 'Omen'],
            'Nélio'                                   => ['', 'Nélio'],
            'HSIX'                                    => ['Carlos Oliva', 'Hsix'],
            'El Mac'                                  => ['Miles Gregor', 'El Mac'],
            'Millo'                                   => ['Francesco Camillo Giorgino', 'Millo'],
            'Gawd'                                    => ['Christopher Ross', 'Gawd'],
            'Alexa Hatanaka'                          => [''],
            'Embassy of Imagination Patrick Thompson' => ['Embassy of Imagination'],
            'MATÉO Mathieu Bories'                    => ['Mathieu Bories', 'Mateo'],
            'Peru Dyer'                               => ['Peru Dyer Jalea', 'Peru 143'],
            'Dan Buller'                              => ['William Daniel Buller'],
            'Astro'                                   => ['', 'Astro'],
            'CASE'                                    => ['Andreas von Chrzanowski', 'Case Maclaim'],
        ];
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

            $model = Artwork::equals('location', $location)->where('title', $title);
            if ($model->count() > 1) {
                error_log('Duplicate found: ' . $title);
                continue;
            }

            if ($model = $model->first()) {
                $model->update(
                    ['title' => $title, 'produced_at' => $produced_at,
                     'category_id' => $category->id, 'subcategory_id' => $subcategory->id,
                     'dimensions' => $dimensions, 'borough_id' => $borough->id,
                     'location' => $location, 'details' => $details,
                     'collection_id' => $collection->id]
                );
            } else {
                $model = Artwork::create(
                    ['title' => $title, 'produced_at' => $produced_at,
                     'category_id' => $category->id, 'subcategory_id' => $subcategory->id,
                     'dimensions' => $dimensions, 'borough_id' => $borough->id,
                     'location' => $location, 'details' => $details,
                     'collection_id' => $collection->id]
                );
            }

            $artist = trim($artwork[14]) . " " . trim($artwork[15]);
            $model->artists()->syncWithoutDetaching(Artist::firstOrCreate( // XXX
                ['name' => $this->artists[$artist] ?? $artist]
            )->id);

            $techniques = array_map('ucfirst', explode('; ', $artwork[8]));
            foreach ($techniques as $technique) {
                $technique = $this->techniques[$technique] ?? $technique;
                if ($technique) {
                    $model->techniques()->syncWithoutDetaching(Artwork\Technique::firstOrCreate( // XXX
                        ['fr' => $technique],
                    )->id);
                }
            }

            $materials = array_map('ucfirst', preg_split('/; | et /',
                preg_replace('/[A-zÀ-ú]+: |\?/', '', $artwork[7])));
            foreach ($materials as $material) {
                $material = $this->materials[$material] ?? $material;
                if ($material) {
                    $model->materials()->syncWithoutDetaching(Artwork\Material::firstOrCreate( // XXX
                        ['fr' => $material],
                    )->id);
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
            if ($artwork[3] != "Montréal") {
                continue;
            }

            $title = trim(preg_replace('/^"|"$/', '', $artwork[0]));

            $produced_at = date_create_from_format('Y-m-d', "$artwork[1]-01-01"); // XXX

            /* $borough = Artwork\Borough::where( */
            /*     'name', $this->boroughs[$artwork[4]] ?? $artwork[4] */
            /* )->first(); */

            $details = trim($artwork[6]); // XXX

            /* XXX */
            preg_match("/(\d+)\s*°\s*(\d+)\s*'\s*(\d+\.\d+)\s*(\"|'')/", $artwork[11], $lat);
            preg_match("/(\d+)\s*°\s*(\d+)\s*'\s*(\d+\.\d+)\s*(\"|'')/", $artwork[12], $lon);
            $location = new Point(
                $this->DMStoDEC($lat[1], $lat[2], $lat[3]),
                -$this->DMStoDEC($lon[1], $lon[2], $lon[3])
            );

            $borough = Artwork\Borough::contains('area', $location)->first();

            $model = Artwork::equals('location', $location)->where('title', $title);
            if ($model->count() > 1) {
                error_log('Duplicate found: ' . $title);
                continue;
            }

            if ($model = $model->first()) {
                $model->update(
                    ['title' => $title, 'produced_at' => $produced_at,
                     'category_id' => $category->id, 'borough_id' => $borough->id,
                     'location' => $location, 'details' => $details,
                     'collection_id' => $collection->id]
                );
            } else {
                $model = Artwork::create(
                    ['title' => $title, 'produced_at' => $produced_at,
                     'category_id' => $category->id, 'borough_id' => $borough->id,
                     'location' => $location, 'details' => $details,
                     'collection_id' => $collection->id]
                );
            }

            /* XXX */
            $artists = preg_split('/,|&|\+| et/', preg_replace('/avec .* de|en .* avec/', ',', $artwork[2]));
            foreach ($artists as $artist) {
                $artist = ucfirst(trim(preg_replace('/^"|[A-zÀ-ú ]+:|équipe de |\(|\)/', '', $artist)));

                $name = trim($this->artists[$artist][0] ?? $artist);
                $alias = $this->artists[$artist][1] ?? null;
                if ($alias) {
                    $model->artists()->syncWithoutDetaching(Artist::firstOrCreate( // XXX
                        ['alias' => $alias], ['name' => $name]
                    )->id);
                } else if ($name) {
                    $model->artists()->syncWithoutDetaching(Artist::firstOrCreate( // XXX
                        ['name' => $name], ['alias' => $alias]
                    )->id);
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
    public function handleDC()
    {
        $json = json_decode(file_get_contents(
            "https://arcgis.com/sharing/content/items/d03d076d190844ad8a9e17df8727b1eb/data"));
        $artworks = $json->operationalLayers[1]->featureCollection->layers[0]->featureSet->features;
        $this->progressBar->setMaxSteps(count($artworks));

        $category = Artwork\Category::where('fr', 'Murales')->first(); // XXX
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
            $details = trim(preg_replace('/  /', ' - ', trim(preg_replace('/<.*?>|&nbsp;.*/', ' ', $artwork->name))));

            $model = Artwork::equals('location', $location)->where('title', $title);
            if ($model->count() > 1) {
                error_log('Duplicate found: ' . $title);
                continue;
            }

            if ($model = $model->first()) {
                $model->update(
                    ['title' => $title, 'category_id' => $category->id,
                     'location' => $location, 'details' => $details,
                     'collection_id' => $collection->id]
                );
            } else {
                $model = Artwork::create(
                    ['title' => $title, 'category_id' => $category->id,
                     'location' => $location, 'details' => $details,
                     'collection_id' => $collection->id]
                );
            }

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
        /* $this->handleDC(); */
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
