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
        DB::table('collections')->updateOrInsert(
            ['name' => 'Dose Culture']
        );
        DB::table('collections')->updateOrInsert(
            ['name' => 'MU']
        );
        DB::table('collections')->updateOrInsert(
            ['name' => 'Université de Montréal']
        );
    }
}
