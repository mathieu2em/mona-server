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
                <h1>Emile Labbé</h1>

                <h2>
                    <a href="{{ asset('storage/reports/Rapport - Labbé.pdf') }}">
                        Rapport
                    </a>
                </h2>

                <h2>4 janvier – 11 janvier</h2>
                <p>
                    Puisque je savais que le projet utiliserait le Framework Kivy, j’ai
                    commencé à me familiariser avec Python et Kivy. J’ai donc fait une
                    application pour tester les différentes fonctionnalités dont nous aurons
                    besoin pour le projet. J’ai eu de nombreux problèmes avec la gestion de
                    données et avec l’appareil photo. La documentation de Kivy est très
                    minimale et les forums ne sont pas très fréquentés comparativement à
                    ceux d’Android Studio ce qui fait en sorte que les problèmes étaient
                    long à résoudre.
                </p>

                <h2>11 janvier – 18 janvier</h2>
                <p>
                    Entre la première et la deuxième rencontre, j’ai continué d’expérimenter
                    avec Kivy surtout avec les données GPS. Les nombreux problèmes
                    rencontrés m’ont incité à essayer React Native comme plateforme que Paul
                    nous a proposer. React Native avait l’avantage d’être une plateforme
                    valide pour IOS et Android.
                    <br/>
                    Mon expérience avec React Native a été très négative puisque je possède
                    très peu d’expérience avec JavaScript. Bien que j’aie réussi à faire une
                    application de base, je n’avais pas l’impression d’être productif.
                    <br/>
                    Suite à ces essais nous avons décidé d’utiliser Android Studio pour la
                    version Android.
                </p>

                <h2>18 janvier – 22 janvier</h2>
                <p>
                    Au cours de la fin de semaine, je me suis habitué au code source fourni
                    par Lena. J’ai pu comprendre quels étaient les éléments que je devrais
                    modifier.
                    <br/>
                    L’analyse du code fourni m’a permis de voir que la gestion de données
                    étaient compliquée ce qui avait empêché les anciens développeurs
                    d’implémenter les fonctions de tri (entre autre).
                </p>

                <h2>22 janvier – 29 janvier</h2>
                <p>
                    Au cours de la dernière réunion, le professeur Guy Lapalme a insisté sur
                    le développement des fonctionnalités essentielles de l’application.
                    J’avais donc planifié de réorganiser le traitement des données.
                    <br/>
                    Malheureusement, mon ordinateur a cessé de fonctionner et j’ai perdu une
                    semaine à essayer de le réparer avant d’acheter un nouveau portable.
                </p>

                <h2>30 janvier – 5 février</h2>
                <p>
                    Durant cette période, j’ai travaillé à ce que l’application ait chercher
                    ses données à partir d’un fichier JSON contrairement à une base de
                    données SQL puisque c’est ce que nous avions convenu.
                    <br/>
                    J’ai dû prévoir 4 scénarios pour la gestion des données, avec ou sans
                    connexion internet et avec ou sans données déjà sauvegardées sur le
                    téléphone. Le but étant de mettre les données à jour sans écraser ce que
                    l’utilisateur a sauvegardé (note, photo, commentaire).
                    Afin de limiter le parsing des données, lors de l’ouverture de
                    l’application, dépendant le scénario, une liste de toute les œuvres est
                    créée et elle sera passée à toutes les activités. L’avantage d’avoir les
                    données sous forme de liste permet de d’accéder aux données très
                    rapidement et de garder un suivi de l’ordre de la liste malgré les
                    changements d’activités.
                </p>

                <h2>5 février au 12 février</h2>
                <p>
                    Durant cette période, j’ai implémenté les fonctions de tri. Le principal
                    problème rencontré a été de mettre à jour l’interface une fois que le
                    tri a été effectué. J’ai également travaillé sur le transfert des
                    données entre les activités. Le passage des données est fait par la
                    classe Parcel via les intents pour des raisons d’efficacité.
                    L’implémentation des parcelles a été problématique puisque tous les
                    objets non primitifs doivent être transformés. J’ai dû revoir la
                    structure des données puisque les objets œuvre avaient une référence
                    vers un objet artiste et vice-versa ce qui créait une boucle infinie.
                    J’ai réussi à implémenter le transfert de données entre deux classes.
                </p>

                <h2>12 février au 19 février</h2>
                <p>
                    Durant cette semaine, j’ai continué de travailler sur le transfert de
                    données entre les différentes activités et fragments. La problématique
                    était qu’il y avait énormément de changement entre les différentes
                    activités et fragments. Malgré le fait que les parcelles étaient
                    ‘efficace’ parfois le transfert ne se faisait pas assez vite et les
                    activités recevaient des parcelles nulles ce qui engendraient des
                    erreurs d’exécution.  J’ai beaucoup travaillé sur réduire le nombre
                    d’activités et de fragments et à régulariser les appels de chacun donc
                    d’envoyer des flags et toujours les mêmes paramètres.
                </p>

                <h2>20 février au 26 février</h2>
                <p>
                    Durant cette semaine, j’ai trouvé la solution à mon problème de gestion
                    de données. J’ai implementé un ROOM database pour gérer les données.
                    Avec le database, j’ai réglé deux problèmes soit la transfert de données
                    et la gestion de données. Le database me permet d’aller rechercher les
                    données si le transfert a été trop lent et permet de storer les données
                    de manière plus simple que sous le format JSON. Le format ROOM a été
                    préféré à SQL car il a un niveau d’abstraction de plus que SQL ce qui
                    permet d’éviter les curseurs. J’ai travaillé à construire mes requêtes
                    et à enregistrer les informations de l’utilisateur dans la base de
                    données.
                </p>
            </div>
        </div>
    </body>
</html>
