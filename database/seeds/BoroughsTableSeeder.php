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
        $boroughs = [
            'AC' => 'Ahuntsic-Cartierville',
            'AJ' => 'Anjou',
            'CN' => 'Côte-des-Neiges–Notre-Dame-de-Grâce',
            'LC' => 'Lachine',
            'LS' => 'LaSalle',
            'PM' => 'Le Plateau-Mont-Royal',
            'SO' => 'Le Sud-Ouest',
            'IS' => 'L’Île-Bizard–Sainte-Geneviève',
            'MH' => 'Mercier–Hochelaga-Maisonneuve',
            'MN' => 'Montréal-Nord',
            'OM' => 'Outremont',
            'PR' => 'Pierrefonds-Roxboro',
            'RP' => 'Rivière-des-Prairies–Pointe-aux-Trembles',
            'RO' => 'Rosemont–La Petite-Patrie',
            'LR' => 'Saint-Laurent',
            'LN' => 'Saint-Léonard',
            'VD' => 'Verdun',
            'VM' => 'Ville-Marie',
            'VS' => 'Villeray–Saint-Michel–Parc-Extension',
        ];

        foreach ($boroughs as $abbr => $name) {
            DB::table('boroughs')->updateOrInsert(
                ['abbr' => $abbr], ['name' => $name]
            );
        }
    }
}
