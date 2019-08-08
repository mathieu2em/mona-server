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
        DB::table('categories')->updateOrInsert(
            ['fr' => 'Beaux-Arts'], ['en' => 'Fine Arts']
        );
        DB::table('categories')->updateOrInsert(
            ['fr' => 'Arts Décoratifs'], ['en' => 'Decorative Arts']
        );
        DB::table('categories')->updateOrInsert(
            ['fr' => 'Murales'], ['en' => 'Murals']
        );
    }
}
