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
            '4U2C',
            'Artducommun',
            'AShop',
            'Atelier TAG',
            'ATOMIC3',
            'BGL',
            'Cooke-Sasseville',
            'Daily tous les jours',
            'Doyon-Rivest',
            'Embassy of Imagination',
            'EN MASSE',
            'Hoarkor',
            'In Situ',
            'Les Industries perdues',
            'Météore Design',
            'Mosaika Art',
            'MU',
            'Parade',
            'Style Over Status',
        ];

        foreach ($collectives as $collective) {
            DB::table('artists')->updateOrInsert(
                ['name' => $collective], ['collective' => true]
            );
        }
    }
}
