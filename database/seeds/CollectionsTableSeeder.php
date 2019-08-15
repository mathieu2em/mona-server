<?php

use Illuminate\Database\Seeder;

class CollectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collections = [
            'Bureau d\'art public, Ville de Montréal',
            'Dose Culture',
            'Murales subventionnées, Ville de Montréal',
            'MU',
            'Université de Montréal',
        ];

        foreach ($collections as $collection) {
            DB::table('collections')->updateOrInsert(
                ['name' => $collection]
            );
        }
    }
}
