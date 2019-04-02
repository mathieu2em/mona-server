<?php

use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
            ['fr' => 'Bois/Menuiserie',   'en' => 'Wood/Woodwork'],
            ['fr' => 'Céramique',         'en' => 'Ceramic'],
            ['fr' => 'Design Industriel', 'en' => 'Industrial Design'],
            ['fr' => 'Émaux',             'en' => 'Enamels'],
            ['fr' => 'Installation',      'en' => 'Installation'],
            ['fr' => 'Mobilier',          'en' => 'Furnishings'],
            ['fr' => 'Mosaïque',          'en' => 'Mosaic'],
            ['fr' => 'Multimédia',        'en' => 'Multimedia'],
            ['fr' => 'Peinture',          'en' => 'Painting'],
            ['fr' => 'Photographie',      'en' => 'Photography'],
            ['fr' => 'Sculpture',         'en' => 'Sculpture'],
            ['fr' => 'Technique Mixte',   'en' => 'Mixed Media'],
            ['fr' => 'Verre',             'en' => 'Glass'],
            ['fr' => 'Vitrail',           'en' => 'Stained Glass'],
        ]);
    }
}
