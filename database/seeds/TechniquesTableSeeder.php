<?php

use Illuminate\Database\Seeder;

class TechniquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $techniques = [
            'Acidulé'         => 'Acidulated',
            'Ancré'           => 'Anchored',
            'Anodisé'         => 'Anodized',
            'Apprêté'         => 'Primed',
            'Armé'            => 'Armed',
            'Assemblé'        => 'Assembled',
            'Biseauté'        => 'Beveled',
            'Boulonné'        => 'Bolted',
            'Briqueté'        => 'Briquetted',
            'Brossé'          => 'Brushed',
            'Chevillé'        => 'Pegged',
            'Cimenté'         => 'Cimented',
            'Ciré'            => 'Waxed',
            'Collé'           => 'Glued',
            'Coulé'           => 'Casted',
            'Coupé'           => 'Cut',
            'Courbé'          => 'Curved',
            'Cuit'            => 'Baked',
            'Découpé'         => 'Cut',
            'Dépoli'          => 'Frosted',
            'Émaillé'         => 'Enameled',
            'Empilé'          => 'Stacked',
            'Encastré'        => 'Embedded',
            'Enfilé'          => 'Donned',
            'Estampé'         => 'Stamped',
            'Fixé'            => 'Fixed',
            'Fondu'           => 'Melted',
            'Forgé'           => 'Forged',
            'Formé'           => 'Formed',
            'Galvanisé'       => 'Galvanized',
            'Gravé'           => 'Carved',
            'Huilé'           => 'Oiled',
            'Ignifugé'        => 'Fireproofed',
            'Imbriqué'        => 'Imbricated',
            'Imprimé'         => 'Printed',
            'Incrusté'        => 'Inlaid',
            'Laminé'          => 'Laminated',
            'Laqué'           => 'Lacquered',
            'Limé'            => 'Filed',
            'Martelé'         => 'Hammered',
            'Meulé'           => 'Ground',
            'Modelé'          => 'Modeled',
            'Monté'           => 'Mounted',
            'Moulé'           => 'Molded',
            'Oxydé'           => 'Oxidized',
            'Patiné'          => 'Patinated',
            'Peint'           => 'Painted',
            'Percé'           => 'Perced',
            'Photographié'    => 'Photographed',
            'Planté'          => 'Planted',
            'Plié'            => 'Folded',
            'Poli'            => 'Polished',
            'Poncé'           => 'Sanded',
            'Programmé'       => 'Programmed',
            'Projeté'         => 'Projected',
            'Pulvérisé'       => 'Pulverised',
            'Sablé'           => 'Sandblasted',
            'Satiné'          => 'Satined',
            'Sculpté'         => 'Sculpted',
            'Sérigraphié'     => 'Screenprinted',
            'Soudé'           => 'Welded',
            'Soufflé'         => 'Blown',
            'Taillé'          => 'Carved',
            'Teint'           => 'Dyed',
            'Tissé'           => 'Woven',
            'Torréfié'        => 'Roasted',
            'Tourné'          => 'Turned',
            'Usiné'           => 'Machined',
            'Verni'           => 'Varnished',
            'Vissé'           => 'Screwed',

            'Aluminium taillé'       => 'Cut aluminum',
            'Contrecollé sur bois'   => 'Laminated on wood',
            'Granit poli'            => 'Polished granite',
            'Pavés découpés'         => 'Cut pavers',
            'Cire perdue'            => 'Lost-wax casting',
            'Coulée industrielle'    => 'Industrial casting',
            'Moulage en sable'       => 'Sand casting',
            'Moulage d\'argile crue' => 'Molding of raw clay',
            'Ciment moulé'           => 'Molded cement',
            'Cuivre repoussé'        => 'Embossed copper',

            'Découpe au laser' => 'Laser cutting',
            'Impression numérique montée à froid sur support en plexiglas' => 'Digital print on plexiglass support',
        ];

        foreach ($techniques as $fr => $en) {
            DB::table('techniques')->updateOrInsert(
                ['fr' => $fr], ['en' => $en]
            );
        }
    }
}
