<?php

use GeoJson\GeoJson;
use Grimzy\LaravelMysqlSpatial\Types\MultiPolygon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoroughsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = json_decode(file_get_contents('http://donnees.ville.montreal.qc.ca' .
            '/dataset/00bd85eb-23aa-4669-8f1b-ba9a000e3dd8' .
            '/resource/e9b0f927-8f75-458c-8fda-b5da65cc8b73' .
            '/download'));

        $boroughs = [
            'CN' => 'Côte-des-Neiges–Notre-Dame-de-Grâce',
            'IS' => 'L’Île-Bizard–Sainte-Geneviève',
            'MH' => 'Mercier–Hochelaga-Maisonneuve',
            'RP' => 'Rivière-des-Prairies–Pointe-aux-Trembles',
            'RO' => 'Rosemont–La Petite-Patrie',
            'VS' => 'Villeray–Saint-Michel–Parc-Extension',
        ];

        foreach ($json->features as $feature) {
            $abbr = $feature->properties->ABREV;
            $name = $boroughs[$feature->properties->ABREV] ?? $feature->properties->NOM;
            $area = MultiPolygon::fromJson(GeoJson::jsonUnserialize($feature->geometry))->toWkt();

            DB::table('boroughs')->updateOrInsert(
                ['abbr' => $abbr],
                ['name' => $name, 'area' => DB::raw("ST_GeomFromText('$area')")]
            );
        }
    }
}
