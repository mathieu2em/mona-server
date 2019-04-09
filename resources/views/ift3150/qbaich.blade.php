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
                <h1>Abdelhakim Qbaich</h1>

                <h2>Plan de développement</h2>

                <p>
                    <b>Date de début : </b><span>7 janvier</span>
                    <br>
                    <b>Date de fin : </b><span>9 avril</span>
                </p>

                <p>Le plan ci-dessous est sujet à changement. Il n'est indiqué qu'à titre
                informatif seulement.</p>

                <h3>Janvier</h3>
                <ul>
                    <li>
                        Préparation de pages web dans le cadre de IFT3150 pour mon collègue
                        et moi, incluant le contenu d'anciens étudiants.
                    </li>
                    <li>
                        Mise en place d'un système automatique d'importation de données avec
                        nettoyage et normalisation.
                    </li>
                </ul>

                <h3>Février</h3>
                <ul>
                    <li>
                        Parité avec le serveur originel en terme de <i>features</i>, avec du
                        code plus simple et plus facile à maintenir.
                    </li>
                    <li>
                        Système d'authentification simple et sécuritaire avec mots de passes
                        <i>hashés</i>.
                    </li>
                    <li>
                        Gestion de la réception et du stockage d'images.
                    </li>
                </ul>

                <h3>Mars</h3>
                <ul>
                    <li>
                        Documentation des <i>endpoints</i> et mise à jour des appels au
                        serveur dans les projets Android et iOS.
                    </li>
                    <li>
                        Implémentation d'une interface administrateur.
                    </li>
                </ul>

                <h2>Rapport hebdomadaire</h2>

                <h4>Semaine 12 : 1 avril au 5 avril</h4>
                <ul>
                    <li>
                        Petit nettoyage de code, qui est maintenant sur le dépôt
                        Git, disponible pour consultation par les autres membres
                        du projet.
                    </li>
                    <li>
                        Le serveur n'est pas encore tout à fait configuré pour
                        pouvoir mettre l'API en ligne.
                    </li>
                    <li>
                        Avancée de l'interface d'administration.
                    </li>
                </ul>

                <h4>Semaine 11 : 25 mars au 29 mars</h4>
                <ul>
                    <li>
                        Après suivi avec un technicien du DIRO, le serveur est presque prêt
                        et sera disponible à partir du sous-domaine
                        <a href="http://picasso.iro.umontreal.ca">picasso</a>.
                    </li>
                    <li>
                        Inclusion de la vérification de rôle ainsi que de l'authentification
                        web au panneau d'administration.
                    </li>
                    <li>
                        Mise à jour du <em>framework</em> Laravel à la version 5.8, avec
                        simplifications et améliorations du code et préparation pour
                        soumission sur le dépôt Git.
                    </li>
                </ul>

                <h4>Semaine 10 : 18 mars au 22 mars</h4>
                <ul>
                    <li>
                        Continuation du développement de l'interface administrateur.
                    </li>
                    <li>
                        Discussion avec les techniciens du DIRO à propos du téléversement
                        d'image et du serveur. Ils ont décidé de créer une machine
                        virtuelle dédiée au projet avec suffisemment d'espace et peu de
                        limitations par rapport à <em>www-ens</em>. Je leur ai envoyé une
                        clé publique SSH, tel que demandé.
                    </li>
                    <li>
                        La mise en ligne de la nouvelle version de l'API et du code est
                        retardée jusqu'à l'obtention de l'accès à une machine virtuelle au
                        DIRO.
                    </li>
                </ul>

                <h4>Semaine 9 : 11 mars au 15 mars</h4>
                <ul>
                    <li>
                        Début du développement de l'interface administrateur.
                    </li>
                    <li>
                        Contact du superviseur pour ce qui est du téléversement d'images.
                    </li>
                </ul>

                <h4>Semaine 8 : 4 mars au 8 mars</h4>
                <ul>
                    <li>
                        Implémentation de la deuxième version d'API. Suite une rencontre
                        avec Lena cette semaine, ce serait idéal d'utiliser directement
                        cette version pour les applications mobiles.
                    </li>
                    <li>
                        Réflexion sur l'implémentation du design de l'interface
                        administrateur, de l'utilisation d'outils JavaScript et des vues
                        (<i>Blade</i>) du <i>framework</i>.
                    </li>
                </ul>

                <h4>Semaine 7 : 25 février au 1 mars</h4>
                <ul>
                    <li>
                        L'implémentation de la première version de l'API est complétée.
                        Il faut que je m'assure de quelques détails et que je teste
                        l'application avec cet API, pour ensuite envoyer des <i>Pull
                        Requests</i>.
                    </li>
                    <li>
                        Modification du schéma de quelques tables de la base de données,
                        principalement celle des utilisateurs générée par défaut.
                    </li>
                    <li>
                        Changement de Lumen vers Laravel, un choix plus logique considérant
                        l'implémentation de l'interface web administrateur à venir bientôt.
                    </li>
                </ul>

                <h4>Semaine 6 : 11 février au 15 février</h4>
                <ul>
                    <li>
                        Utilisation de la librairie DomCrawler pour compléter la collecte de
                        données de sources secondaires. Elle fonctionne sans problème.
                    </li>
                    <li>
                        Création de deux versions de l'API, dont la première tente d'être
                        compatible avec ce qui a été fait auparavant et la deuxième suit
                        les pratiques standardisées d'une API REST.
                    </li>
                    <li>
                        Réflexion sur le versement de fichiers, leur gestion, ainsi que
                        celle de compte utilisateurs en vue de l'implémentation de
                        l'interface administrateur, après les intras, dans les semaines à
                        venir.
                        Il faudra d'ailleurs éventuellement faire la transition vers le
                        nouveau serveur des applications mobiles.
                    </li>
                </ul>

                <h4>Semaine 5 : 28 janvier au 1 février</h4>
                <ul>
                    <li>
                        Petite amélioration du code écrit jusqu'à maintenant.
                    </li>
                    <li>
                        Intégration partielle avec le serveur pour ce qui de la source de
                        données secondaire, principalement par manque de temps.
                        Il est fort probable que je vais inclure une librairie additionnelle
                        au projet pour mieux gérer ça.
                    </li>
                </ul>

                <h4>Semaine 4 : 28 janvier au 1 février</h4>
                <ul>
                    <li>
                        Implémentation de la migration de base de données et le modèle pour
                        l'art et les artistes. La base de données se remplit grâce aux
                        données nettoyées du portail de données ouvertes de la Ville de
                        Montréal.
                    </li>
                    <li>
                        Préparation pour permettre la mise à jour et l'ajout de données à
                        partir d'autres sources secondaires, le tout directement du serveur.
                    </li>
                </ul>

                <h4>Semaine 3 : 21 au 25 janvier</h4>
                <ul>
                    <li>
                        Rencontre avec Lena, Matija et Paul-Philippe pour bien définir le
                        plan de match.
                    </li>
                    <li>
                        Design des pages web pour le cours IFT3150 et complétion de la
                        demande d'inscription.
                    </li>
                    <li>
                        Installation de l'API sous les serveurs du DIRO et déboggage, en
                        partie grâce à l'aide du support technqiue.
                    </li>
                    <li>
                        Préparation et choix d'outil pour le scraping automatique.
                    </li>
                </ul>

                <h4>Semaine 2 : 14 au 18 janvier</h4>
                <ul>
                    <li>
                        Familiarisation avec le code déjà écrit pour le serveur.
                    </li>
                    <li>
                        Prise de décision de niveau architectural pour le serveur, en
                        choisissant de garder le même langage de développement (PHP), mais
                        avec réécriture en utilisant le <i>framework</i> Lumen, selon le
                        style REST.
                    </li>
                    <li>
                        Vérification que les exigences de Lumen sont remplies par les
                        serveurs du DIRO.
                    </li>
                </ul>

                <h4>Semaine 1 : 7 au 11 janvier</h4>
                <ul>
                    <li>
                        Familiarisation avec le projet, suite à la lecture de l'article
                        <a href="{{ asset('storage/Projet MONA.pdf') }}"><i>Recherche,
                        analyse et réflexion concernant la médiation de l'art public par le
                        numérique</i></a>, du groupe de recherche Art+site de l'Université
                        de Montréal.
                    </li>
                    <li>
                        Familiarisation avec l'avancée du projet, après lecture des rapports
                        des anciens étudiants de IFT3150
                        <a href="{{ asset('storage/reports/Rapport - Beauregard.pdf') }}">
                        Vincent G. Beauregard</a>,
                        <a href="{{ asset('storage/reports/Rapport - Labbé.pdf') }}">Émile
                        Labbé</a> et
                        <a href="{{ asset('storage/reports/Rapport - Chaffanet.pdf') }}">
                        Paul-Philippe Chaffanet</a>.
                    </li>
                </ul>

                {{-- <h2>Résumé du rapport final</h2> --}}
            </div>
        </div>
    </body>
</html>
