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
        $categories = [
            'Beaux-Arts'      => 'Fine Arts',
            'Arts Décoratifs' => 'Decorative Arts',
            'Murales'         => 'Murals',
            'Anamorphoses'    => 'Anamorphosis',
        ];

        foreach ($categories as $fr => $en) {
            DB::table('categories')->updateOrInsert(
                ['fr' => $fr], ['en' => $en]
            );
        }
    }
}
