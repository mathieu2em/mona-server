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
        DB::table('boroughs')->insert([
            ['abbr' => 'AC', 'name' => 'Ahuntsic-Cartierville'],
            ['abbr' => 'AJ', 'name' => 'Anjou'],
            ['abbr' => 'CN', 'name' => 'Côte-des-Neiges–Notre-Dame-de-Grâce'],
            ['abbr' => 'LC', 'name' => 'Lachine'],
            ['abbr' => 'LS', 'name' => 'LaSalle'],
            ['abbr' => 'PM', 'name' => 'Le Plateau-Mont-Royal'],
            ['abbr' => 'SO', 'name' => 'Le Sud-Ouest'],
            ['abbr' => 'IS', 'name' => 'L’Île-Bizard–Sainte-Geneviève'],
            ['abbr' => 'MH', 'name' => 'Mercier–Hochelaga-Maisonneuve'],
            ['abbr' => 'MN', 'name' => 'Montréal-Nord'],
            ['abbr' => 'OM', 'name' => 'Outremont'],
            ['abbr' => 'PR', 'name' => 'Pierrefonds-Roxboro'],
            ['abbr' => 'RP', 'name' => 'Rivière-des-Prairies–Pointe-aux-Trembles'],
            ['abbr' => 'RO', 'name' => 'Rosemont–La Petite-Patrie'],
            ['abbr' => 'LR', 'name' => 'Saint-Laurent'],
            ['abbr' => 'LN', 'name' => 'Saint-Léonard'],
            ['abbr' => 'VD', 'name' => 'Verdun'],
            ['abbr' => 'VM', 'name' => 'Ville-Marie'],
            ['abbr' => 'VS', 'name' => 'Villeray–Saint-Michel–Parc-Extension'],
        ]);
    }
}
