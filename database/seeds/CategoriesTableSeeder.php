<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['fr' => 'Beaux-Arts',      'en' => 'Fine Arts'],
            ['fr' => 'Arts Décoratifs', 'en' => 'Decorative Arts'],
            ['fr' => 'Murales',         'en' => 'Murals'],
        ]);
    }
}
