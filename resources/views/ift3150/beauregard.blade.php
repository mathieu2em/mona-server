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
                <h1>Vincent G. Beauregard</h1>

                <h2>
                    <a href="{{ asset('storage/reports/Rapport - Beauregard.pdf') }}">
                        Rapport
                    </a>
                </h2>

                <h2>29 janvier</h2>
                <p>
                    Au cours des précédentes semaines, de nombreuses discussions ont été
                    abordées concernant le point de vue technique de l'application, ce
                    qu'elle doit faire et ce qui doit être implémenté. Pour ma part, côté
                    serveur, PHP et MySql seront utilisés puisqu'ils sont disponibles sur
                    les serveurs de l'université, plus précisément sur
                    <em>www-etud.iro.umontreal.ca</em>. La récente mise à jour des serveurs
                    permet la version 7.2.0 de PHP, ce qui a occasionné quelques troubles
                    techniques puisque le cours 'technologie de l'internet IFT3225-A-E17'
                    que j'ai suivi à l'été 2017 donnait des exemples basés sur des versions
                    antérieures de PHP qui ne sont pas totalement compatibles à PHP 7. Les
                    fonctions disponibles, plus particulièrement celle communiquant avec
                    MySql, ont dû être révisées afin de pouvoir appliquer les tests initiaux
                    <br/>
                    Jusqu'à maintenant, une base de données très simple à été créé pour les
                    tests, soit une table contenant les colonnes <em>Name</em> et
                    <em>Password</em>. Trois fichiers PHP sur le serveur s'occupent alors de
                    communiquer avec la base de données, le premier, config.php, applique
                    les paramètres qui seront nécessaires à la connexion, opendb.php gère la
                    connexion et gère les possibles erreurs initiales et closedb.php
                    s'occupe de fermer la connexion serveur/base de données.
                    <br/>
                    Les fichiers test_post et test_get testent simplement la connexion à
                    l'équivalent d'un <em>Hello World!</em>. Les fichiers tests PHP
                    communiquent directement avec la base de données. Ce qu'ils font :
                    réception d'un <em>username</em>, vérification de son existence dans
                    MySql, puis envoie du résultat sous la forme <em> Name: 'username' -
                    password: 'password'.</em> Vous pouvez tester la version <em>GET</em> en
                    visitant la page web
                    <em>~beaurevg/ift3150/test/test_get.php?username=Paul</em> qui prend
                    pour le paramètre <em>username</em> la valeur <em>Paul</em>, qui fait
                    partie de la base de données de test.
                </p>

                <h2>du 29 janvier au 11 fevrier</h2>
                <p>
                    Au cours des dernières semaines, j'ai passé une partie du temps à tenter
                    de gérer le 'parsing' des fichiers Json disponibles. L'objectif était de
                    créer un algorithme qui prend les deux fichiers Json contenant dans l'un
                    une collection d'art public de la ville de Montréal et dans l'autre une
                    collection de murales dans la ville de Montréal. Je devais créer un
                    fichier secondaire normalisant les données disponibles afin de le rendre
                    facilement  exploitable, peu importe le type d'oeuvre.
                    <br/>
                    Une problématique est survenue, en premier lieu, au niveau des droits
                    sur le serveur. En effet, sur les serveurs de l'université, il est
                    obligatoire de donner une restriction particulière à nos fichiers PHP
                    qui nous empêche de créer ou de modifier les fichiers dans le serveur.
                    La solution temporaire en prévoyant qu'un serveur privé ultérieur nous
                    permette de créer et de modifier des fichiers via PHP est d'envoyer
                    directement une réponse avec un <em>echo</em> ayant l'entête d'un
                    fichier JSON. Bien sûr, cette solution devra être temporaire car pour
                    chaque nouvel utilisateur, un fichier complet doit être généré, ce qui
                    pourrait être problématique dans l'optique d'accueillir de nombreux
                    utilisateurs.
                    <br/>
                    Une seconde problématique ralentit le processus au niveau du format de
                    date dans les fichiers JSON. L'encodage Unix non-signé des dates peut
                    facilement être géré avec PHP cependant, un encodage signé est utilisé
                    dans les fichiers Json exploités. J'ai donc passé beaucoup de temps à
                    lire la documentation disponible sur ce format de date et le tout fut
                    conclu lorsque mes coéquipiers mon informé que ce serait beaucoup plus
                    simple si je leur envoyais ce même format de date qu'ils décoderont
                    facilement côté client.
                    <br/>
                    Pour les prochaines semaines, je prévois terminer une version potable du
                    fichier normalisé pour qu'il puisse être utilisé côté client, débuter
                    les premiers croquis de la base de données, soit : comment les relations
                    seront faites, quelle table sera créée, etc., et bien sur englober le
                    tout dans un fichier simple qui nécessite une requête de la part du
                    client qui sera redirigé vers la bonne fonction.
                </p>

                <h2>du 12 fervrier au 25 fevrier</h2>
                <p>
                    Une première version du fichier Json rassemblant les fichiers de mural
                    et d'art public a été complété, cependant, une version plus vigoureuse
                    et bilingue a été demandée par mes partenaires afin d'assurer un
                    fonctionnement complet suite à d'éventuelles mises à jour des fichiers
                    JSON sources. Le fichier devra également limiter la syntaxe afin de
                    permettre différents tris de catégorie côté client.
                </p>

                <p>
                    L'objectif avant la semaine de lecture sera de terminer ce fichier, du
                    moins, suffisamment pour qu'il puisse être testé côté client. Par la
                    suite, il restera à terminer la base de données SQL puis le côté serveur
                    sera en grande partie complété, nous pourrons ensuite nous concentrer
                    sur les tests usagers.
                </p>

                <h2>du 25 fervrier au 6 mars</h2>
                <p>
                    Le fichier Json est maintenant terminé. Il nécessitera encore des
                    modifications en attendant le feedback de Lena concernant la syntaxe des
                    techniques de création des oeuvres qui varie grandement dans le fichier
                    Json source.
                </p>

                <p>
                    Il est possible de récupérer ce fichier via
                    www-etud.iro.umontreal.ca/~beaurevg/ift3150/server/?request=loadJson
                </p>

                <p>
                    Ce fichier contient une liste d'oeuvre ayant les attributs suivants:
                    <em>id, Titre, TitreVar, Categorie, CategorieANG, SousCategorie,
                    SousCategorieANG, Date</em> (en format unix timestramp)<em>, Materiaux,
                    Technique, Dimension, Arrondissement, Latitude, Longitude</em> et
                    <em>Artiste</em>. <em>Materiaux</em> et <em>Technique</em> contiennent
                    tous les deux une table où chaque élément contient les éléments
                    <em>Nom</em> et <em>NomANG</em>. Pour ce qui est de l'attribut
                    <em>Artiste</em>, celui-ci contient une table où chaque élément contient
                    les éléments <em>Prénom, Nom</em> et <em>NomCollectif</em>.
                </p>

                <h2>du 6 mars au 26 mars</h2>
                <p>
                    Au cours des derniers jours, j'ai apporté plusieurs correctifs au
                    fichier JSON afin d'assurer son bon fonctionnement. J'ai dû ajouter des
                    filtres de 'retour de lignes' et de 'tabs' qui semblaient créer des
                    erreurs sur le <a href="https://jsonlint.com">validateur de fichier
                    JSON</a> que j'ai décidé de respecter puisqu'il était moins permissif.
                    J'ai également séparé la fonction de création de fichier Json de la
                    fonction de téléchargement. Bien qu'il soit impossible d'écrire
                    directement sur le serveur via PHP, j'ai copié manuellement le fichier
                    retourné dans le serveur et j'ai implémenté en local la fonction qui
                    modifie le fichier. Ainsi, lorsque nous téléchargerons le fichier du
                    serveur, il sera possible d'éviter de recréer le fichier déjà existant.
                </p>
                <p>
                    J'ai modifié le code qui initialement se trouvait dans un seul fichier.
                    Le fichier index.php contient maintenant la gestion des principales
                    fonctions, un répertoire 'controle' contient le fichier controle.php,
                    qui lui contient l'ensemble des fonction secondaire nécessaire au
                    'parsing' de fichier. On trouve dans le même répertoire le fichier
                    requeteSQL.php qui gère toutes les interactions avec la communication
                    SQL. Un autre répertoire nommé sql contient les fichiers config.php,
                    opendb.php et closedb.php qui s'occupent d'ouvrir, de fermer et de
                    configurer les paramètres de connexion de la base de données.
                </p>
                <p>
                    Finalement, j'ai implémenté une base de données ainsi que de multiple
                    fonction disponible afin de communiquer avec celle-ci. La table
                    'Oeuvres' contient l'ensemble des identifiants des oeuvres du fichier
                    JSON et le nom de l'oeuvre. Comme les murales n'ont pas de titre, le nom
                    du fichier de l’image lui correspondant à été attribué. Ainsi, lors de
                    la création d'un nouveau fichier JSON côté serveur, les oeuvre ne
                    changeront pas mystérieusement d'identifiant si un des fichiers
                    originales est modifié.
                    <br/>
                    La table Users contient pour l'instant la clé primaire 'UserName',
                    'PassWord' et 'LastLog'. Il sera possible d'ajouter de l'information
                    supplémentaire sur les usagers si nécessaire plus tard.
                    <br/>
                    La table Critics contient en clé primaire les colonnes 'UserName' lié à
                    la même valeur de la table Users, 'IDOeuvre' liée à la colonne ID de
                    'Oeuvres' et 'Date' de type timestamp, et les colonnes 'Comment', 'Note'
                    et 'ShareLink'. Avec ces colonnes en clé primaire, on assure de garder
                    l'historique de toutes les modifications apporté par l'utilisateur.
                    <br/>
                    L'ensemble des fonctions nécessaires sont réalisablent en appelant
                    l'index (www-etud.iro.umontreal.ca/~beaurevg/ift3150/server/), et en
                    appliquant les paramètres nécessaires. Pour l'instant, la réception des
                    paramètres se fait en GET, mais au cours de la semaine, une gestion par
                    POST sera implémentée.
                    <br/>
                    Voici la liste des requêtes applicable aux paramètres 'request' :
                    <ul>
                        <li>
                            createJson : retourne le fichier Json créé via la fonction de
                            parsing
                        </li>
                        <li>
                            loadJson : retourne le fichier Json dans le serveur
                        </li>
                        <li>
                            createUser : crée un nouvel utilisateur, nécessite les
                            paramètres 'username' et 'password' valides.
                        </li>
                        <li>
                            logUser : retourne 1 si l'utilisateur existe, nécessite les
                            paramètres 'username' et 'password'.
                        </li>
                        <li>
                            setLastLog : modifie la date de dernière connexion d'un
                            utilisateur, nécessite les paramètres 'username' et 'password'
                            valides.
                        </li>
                        <li>
                            getLastLog : retourne la date de la dernière connexion d'un
                            utilisateur, nécessite les paramètres 'username' et 'password'
                            valides.
                        </li>
                        <li>
                            addComment : ajoute un commentaire à une oeuvre selon un
                            utilisateur. Nécessite les paramètres 'username', 'password' et
                            'IDOeuvre' valides et 'comment'.
                        </li>
                        <li>
                            addNote : ajoute une note à une oeuvre selon un utilisateur.
                            Nécessite les paramètres 'username', 'password' et 'IDOeuvre'
                            valides et 'note'.
                        </li>
                        <li>
                            addShareLink : ajoute un lien de partage à une oeuvre selon un
                            utilisateur. Nécessite les paramètres 'username', 'password' et
                            'IDOeuvre' valide et 'shareLink'.
                        </li>
                        <li>
                            addCritic : ajoute un lien de partage à une oeuvre selon un
                            utilisateur. Nécessite les paramètres 'username', 'password' et
                            'IDOeuvre' valides et les paramètres optionnels 'shareLink',
                            'comment' et 'note'.
                        </li>
                        <li>
                            getComment retourne le plus recent commentaire à une oeuvre par
                            un utilisateur,  nécessite les paramètres 'username', 'password'
                            et 'IDOeuvre' valides
                        </li>
                        <li>
                            getNote retourne la plus récente note à une oeuvre par un
                            utilisateur, nécessite les paramètres 'username', 'password' et
                            'IDOeuvre' valides
                        </li>
                        <li>
                            getShareLink retourne le plus recent lien de partage à une
                            oeuvre par un utilisateur,  nécessite les paramètres 'username',
                            'password' et 'IDOeuvre' valides
                        </li>
                        <li>
                            getCritic retourne la plus récente critique à une oeuvre par un
                            utilisateur sous la forme d'un fichier Json avec un seul élément
                            aux paramètres 'IDOeuvre', 'comment' , 'note' et 'sharelink'.
                            Nécessite les paramètres 'username', 'password' et 'IDOeuvre'
                            valides
                        </li>
                        <li>
                            getUserData retourne toutes les critiques les plus récente d'un
                            utilisateur pour chaque oeuvre sous forme d'un fichier Json ou
                            chaque éléments est représenté comme les éléments retournés par
                            la fonction getCritic. Nécessite les paramètres 'username' et
                            'password' valides
                        </li>
                    </ul>
                </p>
            </div>
        </div>
    </body>
</html>
