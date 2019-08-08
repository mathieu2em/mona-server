<?php

use Illuminate\Database\Seeder;

class BoroughsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'AC'], ['name' => 'Ahuntsic-Cartierville']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'AJ'], ['name' => 'Anjou']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'CN'], ['name' => 'Côte-des-Neiges–Notre-Dame-de-Grâce']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'LC'], ['name' => 'Lachine']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'LS'], ['name' => 'LaSalle']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'PM'], ['name' => 'Le Plateau-Mont-Royal']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'SO'], ['name' => 'Le Sud-Ouest']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'IS'], ['name' => 'L’Île-Bizard–Sainte-Geneviève']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'MH'], ['name' => 'Mercier–Hochelaga-Maisonneuve']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'MN'], ['name' => 'Montréal-Nord']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'OM'], ['name' => 'Outremont']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'PR'], ['name' => 'Pierrefonds-Roxboro']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'RP'], ['name' => 'Rivière-des-Prairies–Pointe-aux-Trembles']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'RO'], ['name' => 'Rosemont–La Petite-Patrie']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'LR'], ['name' => 'Saint-Laurent']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'LN'], ['name' => 'Saint-Léonard']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'VD'], ['name' => 'Verdun']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'VM'], ['name' => 'Ville-Marie']
        );
        DB::table('boroughs')->updateOrInsert(
            ['abbr' => 'VS'], ['name' => 'Villeray–Saint-Michel–Parc-Extension']
        );
    }
}
