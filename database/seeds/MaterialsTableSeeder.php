<?php

use Illuminate\Database\Seeder;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
            'Acier'                      => 'Steel',
            'Acier chromé'               => 'Chrome steel',
            'Acier inoxydable'           => 'Stainless steel',
            'Acier patinable'            => 'Weathering steel',
            'Aluminium'                  => 'Aluminum',
            'Aggloméré'                  => 'Chipboard',
            'Béton'                      => 'Concrete',
            'Béton hautes performances'  => 'High-performance concrete',
            'Bois'                       => 'Wood',
            'Brique'                     => 'Brick',
            'Bronze'                     => 'Bronze',
            'Calcaire'                   => 'Limestone',
            'Céramique'                  => 'Ceramic',
            'Chrome'                     => 'Chrome',
            'Composantes technologiques' => 'Technological components',
            'Contreplaqué'               => 'Plywood',
            'Diode électroluminescente'  => 'Light-emitting diode',
            'Émail'                      => 'Enamel',
            'Fibre de verre'             => 'Fiberglass',
            'Fibres naturelles'          => 'Natural fibers',
            'Fibres synthétiques'        => 'Synthetic fibers',
            'Formica'                    => 'Formica',
            'Gazon'                      => 'Grass',
            'Granit'                     => 'Granite',
            'Laiton'                     => 'Brass',
            'Métal'                      => 'Metal',
            'Patine'                     => 'Patina',
            'Peinture'                   => 'Paint',
            'Peinture électrostatique'   => 'Electrostatic paint',
            'Pierre'                     => 'Stone',
            'Polyuréthane'               => 'Polyurethane',
            'Poudre d\'oxyde colorée'    => 'Colored oxide powder',
            'Verre'                      => 'Glass',
        ];

        foreach ($materials as $fr => $en) {
            DB::table('materials')->updateOrInsert(
                ['fr' => $fr], ['en' => $en]
            );
        }
    }
}
