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
        DB::table('artists')->updateOrInsert(
            ['name' => '4U2C'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Artducommun'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'AShop'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Atelier TAG'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'ATOMIC3'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'BGL'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Cooke-Sasseville'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Daily tous les jours'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Doyon-Rivest'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Embassy of Imagination'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'EN MASSE'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Hoarkor'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'In Situ'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Les Industries perdues'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Météore Design'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Mosaika Art'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'MU'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Parade'], ['collective' => true]
        );
        DB::table('artists')->updateOrInsert(
            ['name' => 'Style Over Status'], ['collective' => true]
        );
    }
}
