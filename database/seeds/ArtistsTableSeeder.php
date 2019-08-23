<?php

use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collectives = [
            '123Klan',
            '4U2C',
            'Artducommun',
            'Artgang Montreal',
            'Ashop',
            'Atelier in situ',
            'Atelier TAG',
            'ATOMIC3',
            'Au pied du mur',
            'BGL',
            'Cooke-Sasseville',
            'Daily tous les jours',
            'Doyon-Rivest',
            'Ella & Pitr',
            'Embassy of Imagination',
            'EN MASSE',
            'Hoarkor',
            'Humà Design',
            'K6A',
            'Kolab',
            'La Camaraderie',
            'Les Hommes de Lettres',
            'Les industries perdues',
            'Météore Design',
            'Mosaika',
            'MU',
            'Nayan',
            'Style Over Status',
            'The Cheap Art Collective',

            'Jeunes résidents de Place Normandie',
        ];

        foreach ($collectives as $collective) {
            DB::table('artists')->updateOrInsert(
                ['name' => $collective], ['collective' => true]
            );
        }
    }
}
