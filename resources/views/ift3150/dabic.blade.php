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
                    <img src="{{ asset('storage/logo.svg') }}" alt="MONA" height="128px">
                </a>
            </div>
            <div>
                <h1>Matija Dabić</h1>

                <h2>Rapport hebdomadaire</h2>

                <h4>Semaine 13 : 15 au 19 avril</h4>
                <p>
                    Cette semaine j’ai eu la chance de me rattraper sur ma semaine
                    manquée dû à ma blessure. À la suite d’une analyse plus
                    approfondie du code, je distingue que le code des onglets est
                    incohérent et non-structuré en plus d’être incomplet; beaucoup
                    de code entre les fichiers xml et java se <i>overlapp</i> et
                    ne communique simplement pas bien.  Pour ces raisons, j’ai
                    décidé de complètement recommencer cette partie du code pour
                    avoir une meilleure fondation de notre application. La marge
                    de manœuvre dans les méthodes des fonctions est un aspect qui
                    nous a donné beaucoup de trouble. Par exemple, pour chaque
                    fragment, mettre le <i>listener</i> dans le MainActivity ou
                    directement le mettre dans la classe du fragment. Beaucoup de
                    coordination de code à été appris et pris en compte pour faire
                    exécuter le tout.
                </p>
                <p>
                    On a commencé par créer un nouveau TabLayout et le ToolBar de
                    l’application d’où on a bien compris la différence dans les
                    layout (linear, relative, etc). Plusieurs petits problèmes sont
                    survenus dont nous allons devoir y revenir plus tard tel que
                    le fragment de la carte avec la légende désorientée, la glissade
                    entre les onglets du doigt cause des troubles avec la gestion
                    de la carte et d’autre mineur difficulté. Un problème auquel
                    nous avons pu tout de suite s’adresser c’est le boutons
                    <i>overflow</i> des paramètres qui n’apparait plus sur le
                    ToolBar; on a recodé un nouveau menu ressource et changer
                    quelque ligne pour pouvoir l’afficher avec succès sur notre
                    ToolBar et non ActionBar
                </p>
                <p>
                    Un autre aspect du code en général qui me cause beaucoup de
                    difficulté à moi, c’est le montant de <i>‘’hardcode’’</i> dans
                    les fichiers xml. Une meilleure pratique de programmation que
                    j’ai mit en place est créer un style <i>‘’MonaTheme’’</i> d’où
                    on incorpore tous les couleur et texte en relation avec le
                    projet Mona pour pouvoir l’incorporer plus facilement dans
                    différent aspect de l’application tel que le ToolBar et
                    TabLayout. Ensuite, il fallait changer la valeur minimale du
                    API de 15 à 21 pour que le code puisse générer le type des
                    ToolBar mise à jour récemment. Aussi, beaucoup de petite mutation
                    au courant du recodage général des onglets ont causé notre
                    application à crashé pour lequel j’ai profité du VCS et
                    l’historique du code pour revenir à des points spécifiques au
                    temps où l’application s’exécutait correctement pour changer
                    et ramené des commandes. Finalement, je me suis introduis
                    <i>Image Asset Studio</i> pour la création dans les différents
                    formats des icones des onglets (comme expliqué la semaine
                    passée) fournis par nos designers.
                </p>
                <p>
                    On a aussi eu une rencontre avec l’équipe pour mettre au
                    point les détails finales avec les designers sur les trucs à
                    faire avant le lancement prévu en fin mai. Voici une
                    mise-à-jours en ordre de mes nouvelles priorités :
                    <ol>
                        <li>
                            Réparer le fragment de la carte et potentiellement
                            enlever la glissade du doigt entre les onglets
                        </li>
                        <li>
                            Contacter Google Play Store pour les conditions sur
                            le lancement d’une application sur leur marché
                        </li>
                        <li>Rajouter les données au Badges</li>
                        <li>
                            Rendre la liste et la Galerie plus propre et plus
                            belle esthétiquement
                        </li>
                        <li>Configurer le login</li>
                    </ol>
                </p>

                <h4>Semaine 12 : 8 Avril au 12 Avril</h4>
                <p>
                    Pour donner suite à une analyse approfondie sur les codes
                    inutiles des mipmap reporté précédemment, je réalise qu’il y a
                    beaucoup plus de faille au code que j’y croyait initialement;
                    quand on change de scène (par ex : ODJ vers Carte) les icônes
                    des onglets disparaissent. Donc, nous réussissons simplement de
                    les afficher une première fois et pas par après. Je suis donc
                    retournée sur mes pas pour trouver à quelles étapes les icônes
                    disparaissent, simplement pour en venir à la conclusion que même
                    sur les codes de mes prédécesseur; ils éprouvait le même problème.
                </p>
                <p>
                    Après une discussion avec Vincent, j’ai reçu une confirmation
                    que c’était un bug qui n’a pas encore été adressé. Résoudre ce
                    problème risque de rajouter un certain bloc de temps dans mon
                    horaire futur que je juge personnellement important à adresser.
                    Sous tentative de distinguer le code mieux, on crée une classe
                    séparer pour noter pager adapter qui se retrouve dans le
                    MainActivity. Sur ce on remodèle le fichier activity_main.xml
                    autour de TabLayout pour pouvoir proprement reconstruire notre
                    code des onglets et potentiellement incorporer de pouvoir
                    glisser du doigt entre les onglets.
                </p>

                <h4>Semaine 11 : 1e Avril au 5 Avril</h4>
                <p>
                    Je me suis fracturé la main droite en faisant du sport;
                    ainsi je dois porter un plâtre pour le reste du mois
                    d’Avril. Mon médecin m’a avisé de pas utiliser ma main au
                    courant du rétablissement. Malgré ceci, j’ai changé les
                    commandes de ma souris pour pouvoir l’utiliser proprement de
                    ma main gauche ainsi d’avoir un doigt disponible sur ma main
                    droite pour retenir une efficacité minimale. Cependant,
                    aucun travail n’a pu être complété au courant de cette
                    semaine pour cette raison.
                </p>

                <h4>Semaine 10 : 25 Mars au 29 Mars</h4>
                <p>
                    J’éprouve de la difficulté à mettre à jours les icones de
                    l’œuvre du jour, carte, liste et galerie du menu principale
                    d’où le code se retrouve dans la classe MainActivity. Il
                    s’agit d’un diffèrent concept qu’auparavant avec les ImageViews
                    et les Drawables. Maintenant, c’est une question de gestion
                    avec les mipmap. En pratique, elles sont plus utilisées dans
                    les applications pour les icones de petite taille (hdpi, mdpi,
                    xhdpi, xxhdpi, xxxhdpi). Pour éviter la complexité des choses,
                    j’ai simplement rajouté les nouveaux icones dans chaque dossier
                    des mipmap et j’ai ajuster le code cordialement pour les faire
                    apparaitre dans notre menu. Il semble avoir énormément de code
                    inutile dirigé vers une idée antérieure de l’application tel
                    que les icones du menu ont un mode actif et passif. Donc, je
                    dois m’occuper de nettoyer le code inutile pour augmenter
                    l’efficacité du programme.
                </p>

                <h4>Semaine 9 : 18 Mars au 22 mars</h4>
                <p>
                    Après une rencontre avec l’équipe, dû à la complexité du langage
                    Android, on va mettre en priorité la fonctionnalité de l’application
                    pour le lancement :
                    <ol>
                        <li>
                            Mettre-à-jour les icones (objectif non-accompli en noir et
                            blanc/objectif accompli en couleur)
                        </li>
                        <li>Rajouter les données au Badges</li>
                        <li>Configurer le login</li>
                    </ol>
                </p>
                <p>
                    Donc, j’ai commencé par modifier les badges et simplement démontrer les
                    8 districts. On veut que l’icone soit en noir et blanc quand le badge
                    est incomplet pour, par la suite, une fois les objectif du badge
                    atteint, que les couleurs de l’icone s’affiche. Dans notre cas, il
                    suffit simplement de changer de photo une fois que l’objectif est
                    atteint. Après avoir convertit les badge de leur format original PDG en
                    PNG, je les ai placé dans le dossier Drawable.
                </p>
                <p>
                    Cependant, les tests d’affichage nous donnent l’erreur : Canvas: trying
                    to draw too large(132349440bytes) bitmap. Même en essayant de négliger
                    l’erreur pour travailler sur la progression des objectifs de chaque
                    badge, l’application crash avec la même erreur. Donc, on est poussé à
                    absolument réparer l’erreur pour pouvoir continuer. Après plusieurs
                    heures de recherche et de vidéo YouTube, la résolution de l’image était
                    en question. Nous devions créer un dossier drawable alternatif dans le
                    path spécifiquement pour la haute résolution de nos images :
                    drawable-xxhdpi. Ce qui permet au IDE d’aller calibrer la haute
                    résolution de la photo à l’écran du cellulaire Android. Donc, j’ai
                    procéder à rajouter des méthodes pour chaque Badge respectif (noir et
                    blanc simplement pour l’instant) pour pouvoir les afficher et j’ai aussi
                    changer le logo au plus récent.
                </p>

                <h4>Semaine 8 : 11 Mars au 15 Mars</h4>
                <p>
                    Donc, nous avons bypass le login pour se concentrer sur les badges pour
                    l’instant. Après plusieurs tests, j’ai aussi réalisé que la méthode de
                    changer de version par une destruction de migration n’est pas pratique
                    si on désire effectué plusieurs test avec les schéma. Donc, après
                    d’autre recherche sur le web, il y a un plugin nommé ADB
                    (AndroidDataBase) spécifiquement pour AndroidStudio avec lequel on a la
                    possibilité de toujours effacer tout donnée déjà stocker dans la base de
                    données. Ceci nous donnera une plus grande marge de manœuvre avec le
                    développement du code. Lors du lancement de l’application, on débutera
                    avec la version 1.0, et lorsqu’on désirera faire des changements au
                    futur, on pourra officiellement incrémenter la version avec notre
                    méthode de destruction de migration pour effectuer les changements.
                </p>
                <p>
                    Pour ce qui en est des badges, au début, j’était juste capable de
                    changer le nom des badges mais dans l’impossibilité d’en rajouter des
                    nouveaux peux importer combien on rajoutait d’objet dans notre liste de
                    badge. C’était une question de rajouter le positionnement du badge le
                    même nombre de fois qu’on veut rajouter un badge dans le tableau
                    d’integer imageID de la classe BadgeActivity avec R.drawable.center.
                    Maintenant, je vais procéder à a les réarranger et ajuster leurs
                    photo/icone respective.
                </p>

                <h4>Vendredi 8 Mars</h4>
                <p>
                    Après une analyse du message d’erreur, on peut constater qu’il y a une
                    issue au niveau de la migration de la version 1 vers la deuxième. Une
                    migration, en générale est nécessaire pour que l’application s’exécute à
                    la suite des schémas changé (dans notre cas, on désirait changer et
                    modifier la structure des apps) et une version incrémenté. S’il n’y a
                    pas de migration, l’application plante tout court. Par contre, par
                    efficacité, si on ne désire pas fournir de migration mais tout de même
                    fournir un reset de la base de donnée, lorsqu’on crée notre base de
                    donnée, on peut simplement rajouter la méthode
                    <code>fallbackToDestructiveMigration()</code> pour ainsi avoir :
                </p>
                <code>
                    db = Room.databaseBuilder(getApplicationContext(), AppDatabase.class,
                            "oeuvre-database").fallbackToDestructiveMigration().build();
                </code>
                <p>
                    Notre base de données est, alors, mise à jour. Suite à ceci, nous
                    rencontrons un problème avec le login alors que le nom ‘’mona1234’’ ne
                    marche plus. Pour l’instant, on ajuste le code pour skip le login alors
                    qu’on va y revenir plus tard.
                </p>

                <h4>Mercredi 6 Mars</h4>
                <p>
                    Je suis en pleine recherche pour trouver une façon de reset toute la
                    base de données de l’application. C’est principalement ceci qui va
                    m’aider créer et arranger les badges. Par contre, apprendre ceci
                    m’aidera particulièrement pour tout autre changement que je cherche à
                    amener à l’application. J’ai essayé un grand nombre de façons alors que
                    simplement incrémenter la version de la base de données dans la classe
                    AppDatabase causais des problèmes à exécuter l’application. J’ai essayé
                    de rajouter dans la méthode onCreate de FirstActivity :
                    <code>this.deleteDatabase("db")</code> qui était sans succès.
                </p>

                <h4>Mardi 5 Mars</h4>
                <p>
                    Je me suis mit sur l’ajustement des badges dans l’application.
                    J’éprouvais des problèmes avec leur affichages. Peu importe comment j’y
                    effectuait des changements dans le code, les changements n’apparaissait
                    pas dans l’application quand j’exécutais l’application. Par exemple,
                    juste au lieu de qu’un Badge affiche ‘’Art décoratifs’’, je voulais
                    qu’il affiche ‘’TEST’’. Après avoir discuté avec Vincent, il m’a
                    expliqué que c’était une question de changement de version pour la base
                    de données. Sur ce, le code compilait mais, malheureusement,
                    l’application ne réussissais pas à partir.
                </p>

                <h4>Lundi 4 Mars</h4>
                <p>
                    Les dernières deux semaines était plus congestionné pour moi alors que
                    j’étais en mi-session, alors je n’ai pas plus attribué beaucoup de
                    travail au projet. En revanche, pour me reprendre, je dévoue tout ma
                    semaine de relâche a celui-ci.
                </p>
                <p>
                    Pour commencer, comme reporté auparavant, j’ai réussi à ouvrir
                    l’application sur mon cellulaire pour me faciliter l’utilisation et
                    mieux pouvoir l’investiguer au futur. De là, il y avait un problème avec
                    l’affichage de la carte dans l’application avec l’erreur suivante :
                    <i>W/OsmDroid: Problem downloading MapTile: /15/9684/11714 HTTP
                    response: Forbidden.</i> Cela étant, quelques recherches il s’agissait
                    d’une mise-à-jour de la police de Mapnik, soit le producteur de OSM.
                    Suite à quelque petit ajustement au code, j’ai pu résoudre le problème.
                </p>

                <h4>Semaine 6 : 11 février au 15 février</h4>
                <p>
                    La raison du problème de compilation de la semaine passé était
                    simplement l’état du code de la Master branch; le code ne permet pas la
                    compilation de l’application. Ceci explique pourquoi le code de Vincent
                    fonctionnait sans problème et l’autre non. À la suite de ma rencontre
                    avec Vincent, nous avons éprouvé beaucoup de trouble à synchroniser mon
                    IDE avec ma branche sur le GitHub du projet. Précédemment, la branche
                    j’avais créé était un clone de la Master branch qui ne compilait pas.
                    Alors, nous avons supprimer celle-ci pour répliquer la même affaire mais
                    cette fois-ci avec la branche de Vincent. Une fois ma branche créer et
                    le code cloner, pour des raisons inconnues, nous étions incapables de
                    synchroniser celle-ci avec le GitHub du projet. Nous avons jonglé avec
                    énormément de paramètre VCS de Android Studio et nous avons dû
                    réinitialiser beaucoup de celles-ci, pour finalement pouvoir ouvrir un
                    nouveau projet Git à partir du IDE pour qu’il soit finalement bien
                    synchroniser avec le GitHub. Maintenant, chaque fois je fait un
                    changement au code et j’enregistre, le push et commit se font
                    automatiquement avec le GitHub.
                </p>
                <p>
                    Ensuite, le code compilait mais il y avait une erreur au niveau de
                    l’émulateur; il s’allumait correctement mais l’application ne partait
                    pas. J’ai installé tous les plugins et mises-à-jour recommandé par le
                    IDE pour le réparer mais l’erreur survenait toujours. J’ai ensuite
                    installé les versions antécédentes de Android, soit Oreo et Nougat, mais
                    ça ne fonctionnait toujours pas. Finalement, j’ai partiellement résolu
                    le problème en désactivant l’option ‘’Instant run’’ du IDE qui
                    simplement ne permet pas de changement au code lorsque l’émulateur est
                    en train de runner l’application. Pour l’instant, chaque fois je fais
                    une modification au code, je dois fermer et repartir l’application.
                </p>
                <p>
                    Pour la semaine, prochaine je souhaite premièrement, faire marcher
                    l’application directement sur mon téléphone Android et me familiariser
                    avec le code des badges et possiblement effectuer quelque test de
                    réalisation et compilation avec cette section.
                </p>

                <h4>Semaine 5 : 4 février au 8 février</h4>
                <p>
                    Je n’ai pas eu la chance de rencontrer Vincent cette semaine puisqu’il
                    était malade. Cependant, il m’a envoyé un ZIP de son code de
                    l’application Android par email, auquel après deux installations de
                    plugin plus tard, j’ai réussi à compiler et l’afficher sur mon émulateur
                    avec succès.
                </p>
                <p>
                    Par la suite, j’ai passé un gros bloc de temps à me familiariser avec le
                    logiciel Git et son site d’hébergement GitHub :
                </p>
                <ul>
                    <li>Comment grâce a une ligne de commande Git Bash; on peut modifier le
                        contenu des dossiers de notre système</li>
                    <li>L’idée de concept derrière un logiciel de gestion de versions
                        décentralisé</li>
                    <li>L’utilité d’un Dépôt : avantage dans le contenu de l’historique des
                        modifications au niveau du code.</li>
                    <li>Les commandes principales : touch, push, add, pull, checkout et
                        commit.</li>
                    <li>Branching : possibilité d’avoir ta propre version du code en gardant
                        les versions précédentes intact.</li>
                </ul>
                <p>
                    J’ai ensuite cloné le code du dépôt à un répertoire sur mon système pour
                    pouvoir gérer localement le code à l’aide de Git Bash.
                </p>
                <p>
                    Par la suite, beaucoup de temps à été passé dans l’intégration de ma
                    propre branch, soit android-matija, sur le GitHub du projet. J’ai eu de
                    la misère à faire apparaitre celui-ci alors qu’il nécessitait tout
                    simplement d’un push de la Branch avec la commande
                    <pre>git push origin android-matija</pre> et non un checkout simple de
                    ma branch. J’ai effectué quelque test en mergant un fichier test.txt de
                    ma branch à la master branch pour toutefois fermer cette demande de pull
                    pour ainsi garder le code intact.
                </p>
                <p>
                    J’ai procédé à télécharger et extraire le code directement du GitHub en
                    fichier ZIP pour pouvoir travailler dessus directement et non sur le
                    code ZIP envoyer de Vincent. Malheureusement, celui-ci je ne réussissais
                    pas à le compiler avec l’erreur :
                    <em>Could not find com.android.tools.build:gradle:3.0.1.</em>
                </p>
                <p>
                    J’insiste donc pour la semaine prochaine de résoudre ce problème pour
                    pouvoir commencer à effectuer des mini test de familiarisation avec
                    l’application et le langage alors que je rencontre Vincent mardi.
                </p>

                <h4>Semaine 4 : 28 janvier au 1 février</h4>
                <p>
                    Je suis toujours en train de m’apprendre le langage Android :
                    Familiarisation avec l’architecture des composantes physique, les
                    diverses options des plans de conception, le fonctionnement de
                    l’émulateur, les différents objets intégrables, etc. En général, je vise
                    à me mettre à l’aise avec les aspects généraux du IDE pour ainsi pouvoir
                    compiler l’application puis avoir une meilleur compréhension du code.
                </p>

                <h4>Semaine 3 : 21 au 25 janvier</h4>
                <p>
                    À la suite d’une première rencontre avec Paul, j’ai une solide idée et
                    image à quoi doit ressembler le produit final. De mon côté, je continue
                    à me familiariser avec le langage Android et la compilation de
                    l’application et le code.
                </p>

                <h4>Semaine 2 : 14 au 18 janvier</h4>
                <p>
                    Au courant d’une première rencontre avec Vincent, il m’a expliqué le
                    code sur AndroidStudio en détail. La section des badges serait la
                    section qui nécessite le plus de travail actuellement dû à son statut de
                    progrès. Alors, que j’ai aucune expérience en codage avec Android, je
                    vais prendre une à deux semaines pour me familiariser avec le langage et
                    le IDE.
                </p>

                <h4>Semaine 1 : 7 au 11 janvier</h4>
                <p>
                    Je me suis mis à jour avec la lecture de l’article sur la présentation
                    du projet MONA, les rapports des anciens élèves et le syllabus du cours
                    IFT 3150. Aussi, j’ai survoler les codes sur le GitHub et les messages
                    Slack du groupe MONA. J’ai décidé de dédier ma journée du mardi de
                    chaque semaine à la réalisation du projet.
                </p>
            </div>
        </div>
    </body>
</html>
