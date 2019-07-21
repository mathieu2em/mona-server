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
        DB::table('collections')->insert([
            ['name' => 'Dose Culture'],
            ['name' => 'MU'],
            ['name' => 'Université de Montréal'],
        ]);
    }
}
