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
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Bois/Menuiserie'], ['en' => 'Wood/Woodwork']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Céramique'], ['en' => 'Ceramic']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Design Industriel'], ['en' => 'Industrial Design']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Émaux'], ['en' => 'Enamels']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Installation'], ['en' => 'Installation']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Mobilier'], ['en' => 'Furnishings']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Mosaïque'], ['en' => 'Mosaic']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Multimédia'], ['en' => 'Multimedia']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Peinture'], ['en' => 'Painting']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Photographie'], ['en' => 'Photography']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Sculpture'], ['en' => 'Sculpture']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Technique Mixte'], ['en' => 'Mixed Media']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Verre'], ['en' => 'Glass']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Vitrail'], ['en' => 'Stained Glass']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Orfèvrerie'], ['en' => 'Goldsmithery']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Estampe'], ['en' => 'Print']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Collage'], ['en' => 'Collage']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Gravure'], ['en' => 'Engraving']
        );
        DB::table('subcategories')->updateOrInsert(
            ['fr' => 'Dessin'], ['en' => 'Drawing']
        );
    }
}
