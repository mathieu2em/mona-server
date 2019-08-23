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
        $subcategories = [
            'Menuiserie'        => 'Woodwork',
            'Céramique'         => 'Ceramic',
            'Design Industriel' => 'Industrial Design',
            'Émaux'             => 'Enamels',
            'Installation'      => 'Installation',
            'Mobilier'          => 'Furniture',
            'Mosaïque'          => 'Mosaic',
            'Multimédia'        => 'Multimedia',
            'Peinture'          => 'Painting',
            'Photographie'      => 'Photography',
            'Sculpture'         => 'Sculpture',
            'Technique Mixte'   => 'Mixed Media',
            'Verre'             => 'Glass',
            'Vitrail'           => 'Stained Glass',
            'Orfèvrerie'        => 'Goldsmithery',
            'Estampe'           => 'Print',
            'Collage'           => 'Collage',
            'Gravure'           => 'Engraving',
            'Dessin'            => 'Drawing',
        ];

        foreach ($subcategories as $fr => $en) {
            DB::table('subcategories')->updateOrInsert(
                ['fr' => $fr], ['en' => $en]
            );
        }
    }
}
