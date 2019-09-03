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

        $this->artists = [
            'René-Pierre Beaudry (Arpi)'  => ['René-Pierre Beaudry', 'Arpi'],
            'Mathieu Bories (Mateo)'      => ['Mathieu Bories', 'Mateo'],
            'Monk-E'                      => ['', 'Monk.E'],
            'Monk-e'                      => ['', 'Monk.E'],
            'A\'Shop'                     => ['Ashop'],
            'Simon Bachand (Stare)'       => ['Simon Bachand', 'Stare'],
            'Maxime Fortin (4-TIN)'       => ['Maxime Fortin', '4-Tin'],
            'Dodo'                        => ['Doryan Rabilloud', 'Dodo Ose'],
            'Dodo Ose'                    => ['Doryan Rabilloud', 'Dodo Ose'],
            'Dodo Ose)'                   => ['Doryan Rabilloud', 'Dodo Ose'],
            'Zek'                         => ['', 'Zek One'],
            'Zek-One'                     => ['', 'Zek One'],
            'Zek One'                     => ['', 'Zek One'],
            'Astro'                       => ['', 'Astro'],
            'Scribe CSX'                  => ['', 'Scribe CSX'],
            'Omen'                        => ['', 'Omen'],
            'Labrona'                     => ['', 'Labrona'],
            'Nico'                        => ['', 'Nico'],
            'Fluke'                       => ['', 'Fluke'],
            'Shadow'                      => ['', 'Shadow'],
            'Smoky'                       => ['', 'Smoky'],
            'Zilon'                       => ['', 'Zilon Lazer'],
            'Shalak'                      => ['', 'Shalak Attack'],
            'Curiot'                      => ['Favio Martinez', 'Curiot Tlalpazotl'],
            'Rouks'                       => ['', 'ROUKS ONE'],
            'Miss Teri'                   => ['', 'Miss Teri'],
            'Fonki'                       => ['', 'FONKi'],
            'Fleo'                        => ['Rémi Fléo', 'Fléo'],
            'Rémi Fléo'                   => ['Rémi Fléo', 'Fléo'],
            'MC Baldassari'               => ['Marie-Clémentine Baldassari', 'MC Baldassari'],
            'Strike'                      => ['Matt Desilets', 'Striker'],
            'Flying Eric'                 => ['Eric Dufour', 'Flying Eric'],
            'Les Hommes de lettres'       => ['Les Hommes de Lettres'],
            'Ankh One'                    => ['', 'Ankhone'],
            'Collectif Au pied du mur'    => ['Au pied du mur'],
            'Miles "El Mac" Gregor'       => ['Miles Gregor', 'El Mac'],
            'El Mac'                      => ['Miles Gregor', 'El Mac'],
            'Doryan Rabilloud (Dodo Ose)' => ['Doryan Rabilloud', 'Dodo Ose'],
            'Five Eight'                  => ['', 'Five8'],
            'Five 8'                      => ['', 'Five8'],
            'Five8'                       => ['', 'Five8'],
            'Dre'                         => ['', 'Earth Crusher'],
            'Osti one'                    => ['', 'Osti One'],
            'Esprit'                      => ['', 'Esprit'],
            'Pantonio'                    => ['Antonio Correia', 'Pantónio'],
            'Matéo'                       => ['Mathieu Bories', 'Mateo'],
            'Mateo'                       => ['Mathieu Bories', 'Mateo'],
            'Mr Crocks'                   => ['Jimmy Crockett', 'Mr.Crocks'],
            'Cheap Art Collective'        => ['The Cheap Art Collective'],
            'EL MAC'                      => ['Miles Gregor', 'El Mac'],
            'GENE PENDON'                 => ['Gene Pendon'],
            'FRANCIS MONTILLAUD'          => ['Francis Montillaud'],
            'CYRIELLE TREMBLAY'           => ['Cyrielle Tremblay'],
            'CARLOS OLIVA'                => ['Carlos Oliva'],
            'LSNR'                        => ['Lucas Saenger', 'LsnrOne'],
            'Haks 180'                    => [''],
            'les élèves'                  => [''],
            'VHILS'                       => ['Alexandre Manuel Dias Farto', 'Vhils'],
            'PONI'                        => ['Hilda Palafox', 'Poni'],
            'Hans Schmitter'              => ['Hans Schmitter', 'HAKS 180'],
            'SBU'                         => ['', 'SBU One'],
            'Atelier Nayan'               => ['Nayan'],
            'citoyenNes'                  => [''],
            'NAIMO'                       => ['Naïmo Dupéré', 'Naimo'],
            'Naimo'                       => ['Naïmo Dupéré', 'Naimo'],
            'MILLO'                       => ['', 'Millo'],
            'Benny Wliding'               => ['Benny Wilding'],
            'Stack'                       => ['', 'Stack'],
            'Mastrocola'                  => ['Philippe Mastrocola'],
            'Monk.E'                      => ['', 'Monk.E'],
            '1010'                        => ['', '1010'],
            'Nelio'                       => ['', 'Nelio'],
            'Earth Crusher'               => ['', 'Earth Crusher'],
            'Monosourcil'                 => ['Maxilie Martel', 'Mono Sourcil'],
            'Axe Lalime'                  => ['', 'Axe Lalime'],
            'Ella'                        => ['Ella & Pitr'],
            'Pitr'                        => ['Ella & Pitr'],
            'Snikr'                       => ['', 'Snikr'],
            'Axe'                         => ['', 'Axe Lalime'],
            'Lorem Ipsum'                 => ['', 'Lorem Ipsum'],
            'Case Maclaim'                => ['Andreas von Chrzanowski', 'Case Maclaim'],
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dataset  = '53d2e586-6e7f-4eae-89a1-2cfa7fc29fa0';
        $resource = 'd325352b-1c06-4c3a-bf5e-1e4c98e0636b';

        $json = json_decode(file_get_contents(sprintf(
            $this->urlFormat, $dataset, $resource
        )))->features;
        $this->progressBar->setMaxSteps(count($json));

        $category = Artwork\Category::where(
            'fr', 'Murales'
        )->first();
        $collection = Artwork\Collection::where(
            'name', 'Murales subventionnées, Ville de Montréal'
        )->first();

        $this->progressBar->start();
        foreach ($json as $artwork) {
            $artwork = $artwork->properties;
            if (strpos($artwork->artiste, 'Cette murale') !== false) {
                continue;
            }

            $produced_at = date_create_from_format('Y-m-d', "$artwork->annee-01-01"); // XXX

            $location = new Point($artwork->latitude, $artwork->longitude);

            $borough = Artwork\Borough::contains('area', $location)->first();

            $details = trim($artwork->adresse);

            $model = Artwork::equals('location', $location)->where('category_id', $category->id);
            if ($model->count() > 1) {
                error_log('Duplicate found: ' . $details); // XXX
                continue;
            }

            if ($model = $model->first()) {
                $model->update(
                    ['produced_at' => $produced_at, 'category_id' => $category->id,
                     'borough_id' => $borough->id, 'location' => $location,
                     'details' => $details, 'collection_id' => $collection->id]
                );
            } else {
                $model = Artwork::create(
                    ['produced_at' => $produced_at, 'category_id' => $category->id,
                     'borough_id' => $borough->id, 'location' => $location,
                     'details' => $details, 'collection_id' => $collection->id]
                );
            }

            $artists = preg_split('/,|:|&| - | et /i', preg_replace('/\.$/', '', $artwork->artiste));
            if ($artists == ['A\'SHOP-ANKHONE']) {
                $artists = ['Ashop', 'Ankh One'];
            } else if ($artists == ['A\'Shop (Zek']) {
                $artists = ['Ashop', 'Zek'];
            }
            foreach ($artists as $artist) {
                $artist = trim($artist);
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

            /*
            $org = trim(preg_replace('/\(.*?\)/', '', $artwork->organisation));
            if ($org) {
                $model->artists()->syncWithoutDetaching(Artist::updateOrCreate(
                    ['name' => $org], ['collective' => true]
                )->id);
            }
            */

            $this->progressBar->advance();
        }
        $this->progressBar->finish();
    }
}
