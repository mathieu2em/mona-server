<?php

namespace App\Jobs;

use App\Artwork;
use App\Artist;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ImportArtwork implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->urlFormat = 'http://donnees.ville.montreal.qc.ca/' .
            'dataset/%s/resource/%s/download';

        $this->progressBar = new ProgressBar(new ConsoleOutput());

        $this->subcategories = [
            'Bois/menuiserie d\'art' => 'Menuiserie',
            'Design industriel'      => 'Design Industriel',
            'Mosaique'               => 'Mosaïque',
            'Techniques mixtes'      => 'Technique Mixte',
        ];

        $this->artists = [
            'Cardinal Hardy et associés'    => ['Cardinal Hardy'],
            'Yérassimo (Gerasimos) Sklavos' => ['Yérassimo Sklavos', 'Gerasimos'],
            'J.L. Mott'                     => ['J. L. Mott'],
        ];

        /* XXX */
        $this->materials = [
            'Acier corten'            => 'Acier patinable',
            'Acier Corten'            => 'Acier patinable',
            'Acier de Corten'         => 'Acier patinable',
            'Acier intempérique'      => 'Acier patinable',
            'Corten'                  => 'Acier patinable',
            'Béton ductal'            => 'Béton hautes performances',
            'DEL'                     => 'Diode électroluminescente',
            'Chrome poli'             => 'Chrome',
            'Fonte de fer'            => 'Fonte',
            'Criblure granitique'     => 'Granit',
            'Luminaire'               => 'Lumière',
            'Dispositif d\'éclairage' => 'Lumière',
            'Briques'                 => 'Brique',
            'Pavés'                   => 'Pavé',
            'Tissus'                  => 'Tissu',
            'Pierre indiana'          => 'Pierre Indiana',
            'Impression'              => '',
            'Matériaux divers'        => '',
            'Arbres'                  => '',
            'Arbustes'                => '',
            'Plantes'                 => '',
            'Végétaux'                => '',
            'Graminées'               => '',
            'Serrureries'             => '',
            'Livre'                   => '',
            'Plantes indigènes'       => '',
            'Ceramics'                => 'Ceramic',
            'Cobblestones'            => 'Cobblestone',
            'Mortat'                  => 'Mortar',
            'Fiber glass'             => 'Fiberglass',
            'Fiber-glass'             => 'Fiberglass',
            'Pierres'                 => 'Pierre',
            'Stones'                  => 'Stone',
            'Tourbe'                  => 'Gazon',
            'Aluminum'                => 'Aluminium',
        ];

        /* XXX */
        $this->techniques = [
            'Impression'                                 => 'Imprimé',
            'Découpées'                                  => 'Découpé',
            'Polissage'                                  => 'Poli',
            'Coupage'                                    => 'Coupé',
            'Pliées'                                     => 'Courbé',
            'Vidéoprojections'                           => 'Projeté',
            'Mixte'                                      => '',
            'Multiple'                                   => '',
            'Inscription'                                => '',
            'Techniques multiples'                       => '',
            'Aluchromie'                                 => '',
            'Souder'                                     => 'Soudé',
            'Œuvre peinte'                               => 'Peint',
            'Peints'                                     => 'Peint',
            'Peinturé'                                   => 'Peint',
            'Peinture'                                   => 'Peint',
            'Soudure'                                    => 'Soudé',
            'Soudées'                                    => 'Soudé',
            'Soudés'                                     => 'Soudé',
            'Soudage'                                    => 'Soudé',
            'Coulée'                                     => 'Coulé',
            'Boulonnée'                                  => 'Boulonné',
            'Boulonnées'                                 => 'Boulonné',
            'Boulonnage'                                 => 'Boulonné',
            'Anodisation'                                => 'Anodisé',
            'Polissage'                                  => 'Poli',
            'Modelage'                                   => 'Modelé',
            'Moulage'                                    => 'Moulé',
            'Assemblage'                                 => 'Assemblé',
            'Soudées les unes aux autres'                => 'Soudé',
            'Soudées entre elles'                        => 'Soudé',
            'Soudées ensemble'                           => 'Soudé',
            'Contre-collé sur bois'                      => 'Contrecollé sur bois',
            'Découpage au laser'                         => 'Découpe au laser',
            'Coulée industriel'                          => 'Coulée industrielle',
            'Fonte à la cire perdue'                     => 'Cire perdue',
            'Coulé à la cire perdue'                     => 'Cire perdue',
            'Feuilles d\'aluminium anodisé'              => 'Feuilles d\'aluminium anodisées',
            'Fonte au sable'                             => 'Moulage en sable',
            'Frittage laser sélectif'                    => 'Frittage sélectif par laser',
            'Installation par ancrages chimique'         => 'Installation par ancrage chimique',
            'Impression sur papier ilfochrome'           => 'Impression sur papier Ilfochrome',
            'Statue actuelle : fonte'                    => '',
            'Fontaine : moulage'                         => 'Moulé',
            'Aluminium: découpé'                         => 'Découpé',
            'Assemblé Granit: gravé au jet de sable'     => 'Gravé au jet de sable',
            'Finition effectuée par meuleuse à disque'   => 'Fini avec une meuleuse à disque',
            'Ciment fondu'                               => 'Ciment alumineux',
            'Statue originale : cuivre repoussé-estampé' => 'Cuivre repoussé',
            '23 sections de bronze moulées par enrobage' => 'Bronze moulé',
            'Image lumineuse projettée au sol'           => 'Image illuminée projetée sur le sol',
            'Impressions numériques montées à froid sur support de plexiglas' => 'Impression numérique montée à froid sur support en plexiglas',
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dataset  = '2980db3a-9eb4-4c0e-b7c6-a6584cb769c9';
        $resource = '18705524-c8a6-49a0-bca7-92f493e6d329';

        $json = json_decode(file_get_contents(sprintf(
            $this->urlFormat, $dataset, $resource
        )));
        $this->progressBar->setMaxSteps(count($json));

        $collection = Artwork\Collection::where(
            'name', 'Bureau d\'art public, Ville de Montréal'
        )->first();

        $this->progressBar->start();
        foreach ($json as $artwork) {
            $this->normalize($artwork);

            $title = $artwork->Titre;

            if ($artwork->DateFinProduction) {
                preg_match('/(-?\d+)(\d{3})([+-]\d{4})/',
                    $artwork->DateFinProduction, $matches);
                $produced_at = date_create_from_format('UO',
                    $matches[1] . $matches[3]);
            }

            $category = Artwork\Category::where(
                'fr', $artwork->CategorieObjet
            )->first();

            $subcategory = Artwork\Subcategory::where(
                'fr', $artwork->SousCategorieObjet
            )->first();

            $dimensions = $artwork->DimensionsGenerales;

            $borough = Artwork\Borough::where(
                'name', $artwork->Arrondissement
            )->first();

            $location = new Point($artwork->CoordonneeLatitude,
                $artwork->CoordonneeLongitude);

            $details = $artwork->Batiment ?? $artwork->Parc ?? '';

            $model = Artwork::equals('location', $location)->where('title', $title);
            if ($model->count() > 1) {
                error_log('Duplicate found: ' . $title);
                continue;
            }

            if ($model = $model->first()) {
                $model->update(
                    ['title' => $title, 'produced_at' => $produced_at,
                     'category_id' => $category->id, 'subcategory_id' => $subcategory->id,
                     'dimensions' => $dimensions, 'borough_id' => $borough->id,
                     'location' => $location, 'details' => $details,
                     'collection_id' => $collection->id]
                );
            } else {
                $model = Artwork::create(
                    ['title' => $title, 'produced_at' => $produced_at,
                     'category_id' => $category->id, 'subcategory_id' => $subcategory->id,
                     'dimensions' => $dimensions, 'borough_id' => $borough->id,
                     'location' => $location, 'details' => $details,
                     'collection_id' => $collection->id]
                );
            }

            /* Materials */
            foreach ($this->array_zip($artwork->Materiaux, $artwork->MateriauxAng) as $material) { // XXX
                if ($material[0]) { // XXX
                    $model->materials()->syncWithoutDetaching(Artwork\Material::firstOrCreate(
                        ['fr' => $material[0]], ['en' => $material[1]]
                    )->id);
                }
            }

            /* Techniques */
            foreach ($this->array_zip($artwork->Technique, $artwork->TechniqueAng) as $technique) { // XXX
                if ($technique[0]) { // XXX
                    $model->techniques()->syncWithoutDetaching(Artwork\Technique::firstOrCreate(
                        ['fr' => $technique[0]], ['en' => $technique[1]]
                    )->id);
                }
            }

            /* Artists */
            foreach ($artwork->Artistes as $artist) {
                $model->artists()->syncWithoutDetaching(Artist::updateOrCreate(
                    ['name' => $artist->name],
                    ['collective' => $artist->collective, 'alias' => $artist->alias]
                )->id);
            }

            $this->progressBar->advance();
        }
        $this->progressBar->finish();
    }

    /**
     * Normalize the data.
     *
     * @param  object  $artwork
     * @return void
     */
    public function normalize($artwork)
    {
        /* XXX */
        $clean = function($arr) {
            return function($str) use ($arr) {
                $item = $this->mb_ucfirst(trim($str));
                return $arr[$item] ?? $item;
            };
        };

        /* XXX */
        $repeated = function($arr) {
            if (count($arr) < 4) {
                return false;
            }

            $unit = $arr[1];
            for ($i = 1; $i < count($arr); $i += 2) {
                if ($arr[$i] != $unit) {
                    return false;
                }
            }
            return $unit == 'cm' || $unit == 'm';
        };

        $artwork->SousCategorieObjet = $this->subcategories[$artwork->SousCategorieObjet] ?? $artwork->SousCategorieObjet;

        /* XXX */
        $split = '/x++(?!cm|m)|(?<=\d|x)(?=cm|m)|(?<=cm|m)(?=\d)/i';
        $replace = '/\(.*?\)|\s+|\'|:|(?<!\d)\.|(?!c?m)[a-œ]+(?<!x|\\r)/i';
        $dimensions = array_filter(preg_split($split,
            preg_replace('/,/', '.', preg_replace($replace, '',
            $artwork->DimensionsGenerales))));
        if ($dimensions &&
            $dimensions[array_key_last($dimensions)] != 'cm' &&
            $dimensions[array_key_last($dimensions)] != 'm') {
            array_push($dimensions, 'cm');
        }
        if ($repeated($dimensions)) {
            for ($i = 1; $i < count($dimensions); $i += 2) {
                unset($dimensions[$i]);
            }
            $dimensions = array_merge($dimensions);
        }
        $artwork->DimensionsGenerales = $dimensions;

        /* XXX */
        $split = '/;|,| (et|ou|and|or) (?!.*\))/';
        $replace = '/\.|\?|\(.*?\)/';
        $artwork->Materiaux = array_map($clean($this->materials),
            preg_split($split, preg_replace($replace, '', $artwork->Materiaux)));
        $artwork->MateriauxAng = array_map($clean($this->materials),
            preg_split($split, preg_replace($replace, '', $artwork->MateriauxAng)));

        /* XXX */
        $split = '/;|,| (et|ou|and|or) (?!.*\))/';
        $replace = '/\.|\(.*?\)/';
        $artwork->Technique = array_map($clean($this->techniques),
            preg_split($split, preg_replace($replace, '', $artwork->Technique)));
        $artwork->TechniqueAng = array_map($clean($this->techniques),
            preg_split($split, preg_replace($replace, '', $artwork->TechniqueAng)));

        /* Artists */
        $artists = [];
        foreach ($artwork->Artistes as $artist) {
            if ($collective = isset($artist->NomCollectif)) {
                $name = $artist->NomCollectif;
            } else {
                $name = $artist->Prenom . (strlen($artist->Prenom) == 1 ? '. ' : ' ') . $artist->Nom;
            }

            $alias = $this->artists[$name][1] ?? '';
            $name = trim($this->artists[$name][0] ?? $name);

            if ($name != 'Auteur Inconnu') {
                array_push($artists, (object) [
                    'name'       => $name,
                    'collective' => $collective,
                    'alias'      => $alias,
                ]);
            }
        }
        $artwork->Artistes = $artists;
    }

    /**
     * Constructs an array of arrays.
     *
     * @param  array  ...$arrays
     * @return array
     */
    function array_zip(...$arrays)
    {
        return array_map(null, ...$arrays);
    }

    /**
     * Make a string's first character uppercase.
     *
     * @param  string  $str
     * @return string
     */
    public function mb_ucfirst($str)
    {
        return mb_strtoupper(mb_substr($str, 0, 1)).mb_substr($str, 1);
    }
}
