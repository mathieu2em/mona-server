<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BoroughsTableSeeder::class,
            CategoriesTableSeeder::class,
            SubcategoriesTableSeeder::class,
            CollectionsTableSeeder::class,
            MaterialsTableSeeder::class,
            TechniquesTableSeeder::class,
            ArtistsTableSeeder::class,
        ]);
    }
}
