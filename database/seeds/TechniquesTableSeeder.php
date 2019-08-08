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
        DB::table('techniques')->insert([
            ['fr' => 'Acidulé',      'en' => 'Acidulated'],
            ['fr' => 'Ancré',        'en' => 'Anchored'],
            ['fr' => 'Anodisé',      'en' => 'Anodized'],
            ['fr' => 'Apprêté',      'en' => 'Primed'],
            ['fr' => 'Armé',         'en' => 'Armed'],
            ['fr' => 'Assemblé',     'en' => 'Assembled'],
            ['fr' => 'Biseauté',     'en' => 'Beveled'],
            ['fr' => 'Boulonné',     'en' => 'Bolted'],
            ['fr' => 'Briqueté',     'en' => 'Briquetted'],
            ['fr' => 'Brossé',       'en' => 'Brushed'],
            ['fr' => 'Chevillé',     'en' => 'Pegged'],
            ['fr' => 'Cimenté',      'en' => 'Cimented'],
            ['fr' => 'Ciré',         'en' => 'Waxed'],
            ['fr' => 'Collé',        'en' => 'Glued'],
            ['fr' => 'Coulé',        'en' => 'Casted'],
            ['fr' => 'Coupé',        'en' => 'Cut'],
            ['fr' => 'Courbé',       'en' => 'Curved'],
            ['fr' => 'Cuit',         'en' => 'Baked'],
            ['fr' => 'Découpé',      'en' => 'Cut'],
            ['fr' => 'Dépoli',       'en' => 'Frosted'],
            ['fr' => 'Émaillé',      'en' => 'Enameled'],
            ['fr' => 'Empilé',       'en' => 'Stacked'],
            ['fr' => 'Encastré',     'en' => 'Embedded'],
            ['fr' => 'Enfilé',       'en' => 'Donned'],
            ['fr' => 'Estampé',      'en' => 'Stamped'],
            ['fr' => 'Fixé',         'en' => 'Fixed'],
            ['fr' => 'Fondu',        'en' => 'Melted'],
            ['fr' => 'Forgé',        'en' => 'Forged'],
            ['fr' => 'Formé',        'en' => 'Formed'],
            ['fr' => 'Galvanisé',    'en' => 'Galvanized'],
            ['fr' => 'Gravé',        'en' => 'Carved'],
            ['fr' => 'Huilé',        'en' => 'Oiled'],
            ['fr' => 'Ignifugé',     'en' => 'Fireproofed'],
            ['fr' => 'Imbriqué',     'en' => 'Imbricated'],
            ['fr' => 'Imprimé',      'en' => 'Printed'],
            ['fr' => 'Incrusté',     'en' => 'Inlaid'],
            ['fr' => 'Laminé',       'en' => 'Laminated'],
            ['fr' => 'Laqué',        'en' => 'Lacquered'],
            ['fr' => 'Limé',         'en' => 'Filed'],
            ['fr' => 'Martelé',      'en' => 'Hammered'],
            ['fr' => 'Meulé',        'en' => 'Ground'],
            ['fr' => 'Modelé',       'en' => 'Modeled'],
            ['fr' => 'Monté',        'en' => 'Mounted'],
            ['fr' => 'Moulé',        'en' => 'Molded'],
            ['fr' => 'Oxydé',        'en' => 'Oxidized'],
            ['fr' => 'Patiné',       'en' => 'Patinated'],
            ['fr' => 'Peint',        'en' => 'Painted'],
            ['fr' => 'Percé',        'en' => 'Perced'],
            ['fr' => 'Photographié', 'en' => 'Photographed'],
            ['fr' => 'Planté',       'en' => 'Planted'],
            ['fr' => 'Plié',         'en' => 'Folded'],
            ['fr' => 'Poli',         'en' => 'Polished'],
            ['fr' => 'Poncé',        'en' => 'Sanded'],
            ['fr' => 'Programmé',    'en' => 'Programmed'],
            ['fr' => 'Pulvérisé',    'en' => 'Pulverised'],
            ['fr' => 'Sablé',        'en' => 'Sandblasted'],
            ['fr' => 'Satiné',       'en' => 'Satined'],
            ['fr' => 'Sculpté',      'en' => 'Sculpted'],
            ['fr' => 'Sérigraphié',  'en' => 'Screenprinted'],
            ['fr' => 'Soudé',        'en' => 'Welded'],
            ['fr' => 'Soufflé',      'en' => 'Blown'],
            ['fr' => 'Taillé',       'en' => 'Graven'],
            ['fr' => 'Teint',        'en' => 'Dyed'],
            ['fr' => 'Tissé',        'en' => 'Woven'],
            ['fr' => 'Torréfié',     'en' => 'Roasted'],
            ['fr' => 'Tourné',       'en' => 'Turned'],
            ['fr' => 'Usiné',        'en' => 'Machined'],
            ['fr' => 'Vissé',        'en' => 'Screwed'],
        ]);
    }
}
