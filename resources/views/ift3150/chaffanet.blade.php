<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Application de découverte d'art public</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="my-4 text-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('storage/logo.jpg') }}" alt="MONA">
                </a>
            </div>
            <div>
                <h1>Paul-Philippe Chaffanet</h1>

                <h2>
                    <a href="{{ asset('storage/reports/Rapport - Chaffanet.pdf') }}">
                        Rapport
                    </a>
                </h2>

                <h2>11 janvier - 18 janvier</h2>
                <p>
                    Lors de cette période, j’ai expérimenté le framework Kivy. J’ai tenté de
                    mettre en place une interface simple afin d’être en mesure de prendre
                    une photo avec mon téléphone et l’enregistrer dans le téléphone.
                    Cependant, j’ai eu quelques doutes à propos de Kivy (documentation très
                    pauvre quant au module photo) et l’interface de base proposé par Kivy
                    (boutons extrêment customizables). Je me suis donc mis à la recherche
                    d’un autre framework plus adapté à notre projet d’application, tout en
                    gardant la composante cross-platform qui était l’avantage principal que
                    l’on recherchait dans Kivy. Je me suis donc intéressé aux frameworks
                    utilisés par les applications de réseaux sociaux et j’ai découvert que
                    Facebook / Instagram avait développé le framework cross-platform React
                    Native. Comme lors de mon essai avec Kivy, j’ai voulu codé la prise et
                    l’enregistrement de photo sur Android et iOS. Bien que mon code
                    fonctionnait sous iOS, j’ai eu beaucoup de mal à le faire fonctionner
                    pour Android. Après quelques recherches, je crois que c’est le module
                    photo (https://github.com/react-native-community/react-native-camera)
                    qui présentait quelques bugs avec la nouvelle version d’Android.
                    <br/>
                    Bien que séduit par React Native qui correspondait parfaitement à nos
                    besoins de développement pour "MONArt", j’ai "pataugé" pendant un jour
                    ou deux à essayer de trouver une solution pour résoudre le bug qui
                    concernait Android, sans succès. Ceci m’a convaincu que les SDK natifs
                    semblaient être plus adaptés afin de proposer une application
                    fonctionnelle plus rapidement.
                </p>

                <h2>18 janvier - 22 janvier</h2>
                <p>
                    Lors de la période du 18 janvier au 22 janvier, j’ai développé un
                    formulaire d’inscription en Swift avec Xcode. Mon but était de pouvoir
                    faire une requête http permettant l’inscription d’un utilisateur.
                    Développer le formulaire n’a pas été difficile, mais je me suis beaucoup
                    interrogé sur la partie http car j’étais plutôt incertain sur la
                    procédure à suivre pour transmettre un mot de passe en toute sécurité.
                    J’ai fait quelques recherches mais cela nécessiterait un certain temps
                    pour savoir quelle est la bonne marche à suivre afin de ne pas
                    compromettre la sécurité de l’application et de la base de données
                    utilisateurs. Arrivé à la réunion du 22 janvier, j’étais toujours
                    incertain quant à la procédure.
                </p>

                <h2>22 janvier - 29 janvier</h2>
                <p>
                    Au cours de la dernière réunion, le professeur Guy Lapalme m’a conseillé
                    de laisser de coté la partie sécuritaire de mon formulaire et que nous
                    verrons cette partie que bien plus tard si nous en avions le temps. Pour
                    le moment, transmettre le mot de passe en clair serait tout à fait
                    valable dans notre phase de développement. Il a insisté sur la nécessité
                    d’obtenir une application fonctionnelle mais pas forcément sécuritaire
                    d’ici la fin de la session. Ainsi, nous devions plus nous concentrer sur
                    les fonctionnalités propres de l’application, à savoir la
                    géolocalisation, la carte, la prise de photo, l’affichage de nos donnés
                    qui sont sous format JSON, etc.
                    <br/>
                    Ainsi, je me suis concentré lors de cette période du 22 au 29 janvier à
                    développer une liste (sous iOS/Xcode) capable d’afficher toutes les
                    données JSON dont nous disposions. J’ai également codé que lorsque que
                    l’on clique sur un élément de la liste, une view propre à l’élément
                    s’ouvrait afin d’afficher plus d’informations.
                </p>

                <h2>Du 29 janvier au 5 février</h2>
                <p>
                    Au cours de cette semaine, j’ai surtout effectuer un travail de fond. Je
                    dois rappeler que je ne suis pas encore très à l’aise avec Swift, j’ai
                    donc découvert un nouveau paradigme de programmation appelé "Protocol
                    oriented programming", qui est est une variante très intéressant à la
                    POO type Java (voir https://developer.apple.com/videos/play/wwdc2015/408
                    , en particulier les diaporamas). J’ai donc adapté mon style de
                    programmation à celui préconisé par Swift.
                    J’ai mis en place la récupération du fichier JSON sur le serveur par
                    requête HTTP selon 4 cas :
                    <ul>
                        <li>
                            Si l’usager n’a pas internet, et qu’il n’y a pas de données
                            encore sauvegardées dans son téléphone (c’est le cas notamment
                            lorsqu’un usager ouvre l’application pour la toute première fois
                            sur son téléphone sans qu’il n’y ait de connexion internet),
                            alors utiliser le fichier JSON de base incorporé dans
                            l’application.
                        </li>
                        <li>
                            Si l’usage a internet, mais n’a pas de données encore
                            sauvegardées, alors télécharger le dernier fichier JSON sur le
                            serveur, et sauvegarder ces données dans le téléphone.
                        </li>
                        <li>
                            Si l’usager n’a pas internet, mais des données déjà
                            sauvegardées, alors l’application peut se lancer car on dispose
                            des données nécessaires à son affichage.
                        </li>
                        <li>
                            Si l’usager a internet, et des données sauvegardées, alors
                            télécharge le fichier JSON sur le serveur, et met à jour les
                            données.
                        </li>
                    </ul>
                    Pour la persistence des données, deux solutions s’offre au développeur
                    dans iOS: NSCoding, la plus simple, utile pour des ensemble de données
                    assez restreint. CoreData, la plus complexe, très utile lorsque qu’on a
                    un grand nombre d’objets (s’il est nécessaire d’avoir 500000 objects en
                    mémoire par exemple)
                    <br/>
                    Étant donné notre ensemble de donnés restreint (600 oeuvres d’art max),
                    mon choix a été d’utiliser NSCoding pour la persistence des données, qui
                    présente également l’avantage d’une implémentation plus simple (qui
                    consiste la définir la manière d’encoder les objets et de les décoder).
                    J’ai également appris lors de cette période a installer des packages.
                    Swift ne propose pas actuellement de package manager pour iOS. Or,
                    l’utilisation de packages pour effectuer certains tâches de manière plus
                    simple s’avère très utile: SwiftyJSON pour le parsing, HermesNetwork
                    pour les requêtes HTTP. Cela m’a pris un certain temps avant de
                    comprendre l’utilisation de CocoaPods, un programme qui permet
                    l’installation de packages pour iOS.
                    <br/>
                    Par ailleurs, j’ai implémenté une barre de recherche dans la barre de
                    navigation (mais pour le moment, je n’ai pas encore codé l’affichage des
                    données de la recherche), j’ai changé le style de la liste (au lieu de
                    texte pur, j’ai ajouté une image dans la cellule de liste d’oeuvres
                    d’art afin que la liste soit plus agréable à parcourir) et j’ai commencé
                    à travailler les animations afin de pouvoir faire apparaître de manière
                    sympathique la barre de recherche, bien que ça ne marche pas encore
                    comme j’aimerais.
                </p>

                <h2>Du 5 février au 12 février</h2>
                <p>
                    Nous nous sommes fixés comme objectif de terminer les listes et la carte
                    d’ici deux semaines.
                    <br/>
                    Je m’étais pour le moment contenter d’afficher seulement les oeuvres
                    d’art dans une liste, et lorsque que l’on cliquait sur une cellule, les
                    détails de l’oeuvre d’art s’afficher dans une nouvelle view. Par
                    ailleurs, Lena souhaite une application en anglais et en français.
                    <br/>
                    Mon objectif cette semaine était donc d’afficher toutes les listes
                    (Oeuvres d’art, Artiste, Catégorie, etc.) en bilingue. Je me suis donc
                    intéressé à savoir quelles étaient les bonnes pratiques pour afficher
                    des données en multi-lingues dans mon application.
                    <br/>
                    J’ai donc décidé de procéder de la façon suivante:
                    <br/>
                    créer des objets Catégorie, Technique, Materiaux, etc qui auront chacun
                    une référence sur les oeuvres d’art auxquelles ils sont associées. Ces
                    objets ont également un attribut "names" qui contient un dictionnaire
                    avec pour clé la langue et pour valeur une string correspondant au nom
                    de l’objet. Exemple: pour une technique, on a un dictionnaire
                    [.en : "bolted", .fr : "boulonné"]. Un autre attribut existe appelé
                    "name". Par exemple, un object District (arrondissement) n’a pas de
                    traduction. Les objets Catégorie, Technique en ont une. Ma solution est
                    de fournir un getter pour l’attribut name qui retourne le bon "name" en
                    fonction de la langue choisie par l’usager (en se basant sur le
                    paramètre enregistré par défaut) grâce au dictionnaire mentionné plus
                    haut, et si il n’y pas de dictionnaire, alors retourner tout simplement
                    le nom en langue originale (par exemple, un arrondissement (District)
                    n’a pas de traduction, donc je renvois le nom directement sans avoir à
                    chercher dans le dictionnaire)
                    <br/>
                    Les string static comme "Oeuvre d’art", "Catégorie", "Inconnu" doivent
                    également être traductibles et être affichées dans la langue préférée de
                    l’usager. Pour cela, un fichier "*.strings" est utilisé et je fais appel
                    à une fonction du framework foundation afin d’afficher dans la string
                    dans la langue choisie en une seule ligne de code au lieu d’effectuer
                    des "if…else" à chaque fois. Hypothétiquement par la suite, si une
                    nouvelle langue doit être ajoutée, il sera seulement nécessaire
                    d’effectuer les traductions dans un nouveau fichier "*.strings" ce qui
                    facilite grandement la maintenance de l’application.
                    <br/>
                    Grâce à la création de tous ces objets, j’ai accès très facilement aux
                    oeuvres d’art taguées par une catégorie, puisque chaque catégorie
                    contient une référence aux oeuvres d’art qu’elle contient. Désormais,
                    pour afficher les listes, en fonction de la section choisie par l’usager
                    (Artistes, Oeuvres d’art, Arrondissements, Techniques, Matériaux), je
                    peux facilement afficher les noms des objets, et leurs oeuvres d’art
                    associées dans une autre view.
                    <br/>
                    J’ai également mis en place des filtres au sein d’une liste, à savoir
                    pour le moment le tri par nom et par date (De A à Z et de Z à A, par
                    Date (du plus récent au moins récent et inverserment). Je dois encore
                    implémenter le tri par Distance (oeuvre d’art à partir de ma position).
                    <br/>
                    Je me fixe comme objectif pour la période allant du 12 février au 19
                    février d’implémenter la partie localisation (carte, distance,
                    itinéraire?)
                </p>

                <h2>12 février - 19 février</h2>
                <p>
                    Au cours de cette semaine, j’ai implémenté le tri par distance des
                    oeuvres d’art. J’effectue une demande de localisation unique de l’usager
                    ce qui me permet alors de trier par distance (en mètres) les oeuvres
                    d’art les plus proches. Pour le moment, cette demande de localisation
                    est un peu longue, je vais voir au cours des prochaines semaines comment
                    l’améliorer.
                </p>
                <p>
                    J’ai également implémenter la recherche d’oeuvres d’art, d’artistes, des
                    catégories, etc. avec une nouvelle view, mais je ne suis pas encore
                    convaincu de l’animation effectuée.
                </p>
                <p>
                    Par ailleurs, étant donné le nombre assez important d’oeuvres d’art
                    (l’application pourrait contenir jusqu’à 700 oeuvres d’art), j’ai mis en
                    place un index sur la côté droit de l’écran permettant de parcourir très
                    rapidement les listes sans avoir à scroller parmis les 600 oeuvres.
                    Encore une fois, je ne suis pas encore complètement satisfait de
                    l’affichage de mon index, le nombres de dates pour les oeuvres d’art
                    étant particulièrement important, l’index est trop grand. Je dois donc
                    améliorer cet aspect.
                </p>
                <p>
                    Enfin, j’ai implémenté très rapidement la carte, et j’affiche enfin
                    toutes les oeuvres d’art sur cette carte. Je dois encore permettre la
                    localisation de l’usager sur la carte, et permettre le tri des oeuvres
                    d’art: un code couleur doit être décider afin de faciliter le tri, ainsi
                    qu’un menu déroulant (en haut à gauche de la carte) permettant de trier
                    les oeuvres d’art (par exemple en différenciant les oeuvres d’art
                    "classiques" des murales).
                </p>

                <h2>19 février - 26 février</h2>
                <p>
                    Au cours de cette semaine, j’ai enfin obtenu l’index que je désirais et
                    qui se comporte comme je le souhaitais. J’ai donc terminé cet aspect.
                    Cela m’a pris une dizaines d’heures afin d’obtenir le comportement
                    souhaité.
                </p>
                <p>
                    J’ai également amélioré le tri par distance: il suffit désormais de
                    "tirer" la liste afin de mettre à jour la position de l’usager et
                    afficher la distance de l’usager aux oeuvres d’art par rapport à cette
                    position rafraîchie. L’usager peut ensuite trier par distance la liste
                    d’oeuvres d’art par rapport à cette dernière position.
                </p>
                <p>
                    Enfin, j’ai grandement amélioré l’animation d’apparition de la barre de
                    recherche, mais il me reste encore quelques améliorations à effectuer
                    pour la disposition des résultats de la recherche, mais la
                    fonctionnalité en elle-même fonctionne parfaitement.
                </p>

                <h2>26 février - 5 mars</h2>
                <p>
                    Lors de cette semaine, j’ai amélioré la disposition des résultats de la
                    recherche. Lorsque qu’une recherche est effectuée, j’affiche jusqu’à 4
                    sections au sein de la liste résultats: une section "Artiste", une
                    section "Oeuvres", une section "Catégorie" et une section
                    "Arrondissements". À chaque lettre entrée dans la barre de recherche, la
                    liste de résultats se met à jour immédiatement. Afin que la liste de
                    résultats ne soit pas trop grande, je n’affiche que 3 résultats maximum
                    par section correspondant à la recherche. Il suffit alors de cliquer sur
                    le nom d’une section pour afficher l’ensemble des résultats
                    correspondant à la recherche pour cette section.
                </p>

                <h2>5 mars - 12 mars</h2>
                <p>
                    Lors de cette semaine, j’ai ajouté un historique des recherches
                    effectuées par l’usager. À chaque recherche effectuée par l’usager, je
                    l’enregistre dans la téléphone. Ainsi, l’usager peut accéder à son
                    historique de recherche afin de retrouver plus facilement une oeuvreé
                </p>

                <h2>12 mars - 19 mars</h2>
                <p>
                    Le but de cette semaine était d’améliorer la fiche d’une oeuvre.
                    Visuellement, j’ai amélioré l’apparence de la description d’une oeuvre
                    (Titre, artiste, date, dimensions, catégorie et sous-catégorie) et la
                    localisation d’une oeuvre (arrondissement et aperçu de l’emplacement
                    d’une oeuvre sur la carte). Par ailleurs, j’ai mis en place deux
                    boutons, un bouton d’action et un bouton de partage. Le bouton d’action
                    offre trois possibilités: prendre une photo, choisir une photo, ajouter
                    une oeuvre à sa wishlist. On peut prendre une photo avec l’APN afin que
                    cette photo devienne la photo de la fiche d’une oeuvre. J’ai également
                    mis en place la possibilité de choisir une photo dans la photothèque de
                    l’Iphone et l’utiliser pour la fiche d’une oeuvre. J’ai également ajouté
                    la possibilité d’ajouter une oeuvre dans une wishlist, mais je n’ai pas
                    encore fini d’avoir programmé cette possibilité. J’ai également ajouté
                    la possibilité de noter une oeuvre avec une note sur 5 étoiles.
                </p>
                <p>
                    En ce qui concerne le bouton de partage, j’ai programmé la possibilité
                    de tweeter à propos d’une oeuvre d’art avec la photo associée.
                </p>

                <h2>19 mars - 26 mars</h2>
                <p>
                    Mise en place du cas d’utilisation spécifié en réunion:
                    L’usager se trouve sur la view de la fiche d’une oeuvre. Aucune note et
                    aucun bloc comentaire n’existe tant qu’il n’y pas de photo associée à
                    une oeuvre
                    <ul>
                        <li>
                            1. Lorsque que l’usager clique sur "prendre la photo" d’une
                            oeuvre avec l’APN du téléphone, géolocaliser l’usager.
                        </li>
                        <li>
                            Si la géolocalisation indique que l’usager n’est pas proche de
                            l’oeuvre (distance de moins de 10m  (à quel point le gps est
                            précis?)), alors refuser l’ouverture de l’APN et indiquer que
                            l’usager se trouve trop loin de l’oeuvre d’art pour pouvoir en
                            prendre la photo. Fin du cas d’utilisation.
                        </li>
                        <li>
                            Si la gélocalisation indique que l’usager est proche de
                            l’oeuvre, ouvrir l’appareil photo.
                        </li>
                        <li>
                            L’APN peut s’ouvrir. L’usager prend la photo. Donner la
                            possibilité de reprendre la photo ou de la valider.
                        </li>
                        <li>
                            Après avoir valider la photo, l’usager doit donner une note sur
                            5 étoiles (note allant de 1 à 5). Si l’usager ne donne pas de
                            note, il ne peut pas passer à l’étape 4. Une fois que la note
                            est donné, l’usager peut passer à l’étape 4.
                        </li>
                        <li>
                            Donner la possibilité à l’usager de donner un commentaire. Cette
                            étape est optionnelle. Il peut ne pas donner de commentaire et
                            passer à l’étape 5.
                        </li>
                        <li>
                            Afficher la note et le bloc commentaire en bas de la fiche d’une
                            oeuvre. Le bloc commentaire est éditable à tout moment.
                        </li>
                    </ul>
                </p>

                <h2>26 mars - 2 avril</h2>
                <p>
                    J’ai terminé de programmé la wishlist. On peut désormer "cibler" une
                    oeuvre d’art afin de l’ajouter à la wishlist à partir de n’importe quel
                    endroit de l’application.
                    <br/>
                    Lorsqu’une oeuvre est prise en photo, celle-ci est ajoutée à la liste
                    collection.
                    Mise en place très basique d’un login usager, et envoie des données
                    (notes et commentaires) d’une oeuvre au serveur.
                    <br/>
                    Génération de thumbnails => permet une utilisation moins intense de la
                    ram lors de l’affiche d’une liste d’oeuvres d’art.
                    <br/>
                    Mise en place d’un tri sur la carte des oeuvres d’art => possibilité de
                    trier les oeuvres d’art collectionnés et les oeuvres d’art ciblés.
                    <br/>
                    Mise en place de l’accès à une oeuvre d’art à partir de la carte.
                </p>

                <h2>2 avril - 9 avril</h2>
                <p>
                    Quelques légères améliorations au niveau de la performance, mais des
                    changements sont encore nécessaire dans le code pour améliorer
                    l’utilisation de la ram du téléphone: des plantages peuvent être
                    ocassionés lors d’une longue utilisation de l’application.
                    <br/>
                    Correction de quelques bugs de navigation (bouton pour revenir à l’écran
                    de recherche, etc.)
                    <br/>
                    Écriture du rapport pour le projet.
                </p>
            </div>
        </div>
    </body>
</html>
