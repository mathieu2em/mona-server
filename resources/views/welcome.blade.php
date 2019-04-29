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
                <h1>Application de découverte d'art public</h1>
                <p>Un projet de développement d'une application mobile, visant la découverte de l'art public, mené par le <a href="https://histart.umontreal.ca">Département d'histoire de l'art et d'études cinématographiques</a>, en coopération avec le <a href="https://diro.umontreal.ca"> Département d'informatique et de recherche opérationnelle </a>, l'<a href="https://design.umontreal.ca">École de design (Faculté de l'aménagement)</a> et la <a href="https://droit.umontreal.ca"> Faculté de droit</a> en plus d'un partenariat avec le Bureau d'art public de la ville de Montréal.</p>

                <h2>IFT 3150</h2>
                <p>Ce projet, initié dans le cadre du cours Interfaces personne-machine par Daniel Jimenez et <a href="https://lenamk.github.io">Lena Krause</a> en 2015, représente aujourd'hui un projet d'envergure pour le département de l'histoire de l'art impliquant des étudiants de différents départements, notamment d'informatique. Le projet consiste à créer une application mobile qui sera distribuée via App Store (iOS) et Google Play (Android) où les utilisateurs pourront photographier et critiquer les œuvres d'art public. L'application aura pour principale fonctionnalité d'identifier les différentes œuvres à travers Montréal et de permettre aux utilisateurs de partager sur les réseaux sociaux leur découverte. Ainsi, il sera possible d'accumuler des données concernant la rétroaction du public par rapport à l'art, ce qui est peu documenté de nos jours.</p>
                <p>L'objectif des programmeurs sera donc de créer l'application disponible sur les deux principales plateformes mobiles soit iOS et Android. Cela inclut alors d'exploiter les fichiers JSON disponibles, d'appliquer des algorithmes de géolocalisation, d'ajuster les différentes permissions de l'application, d'ajouter un système de mise à jour et de gérer un serveur de synchronisation et de normalisation pour les différentes plateformes.</p>
                <p>Les projets sont sous la direction de Prof. <a href="http://rali.iro.umontreal.ca/lapalme">Guy Lapalme</a>.</p>

                <div class="row">
                    <div class="col">
                        <h3>Hiver 2019</h3>
                        <ul>
                            <li><a href="{{ url('ift3150/dabic') }}">Matija Dabić</a></li>
                            <li><a href="{{ url('ift3150/qbaich') }}">Abdelhakim Qbaich</a></li>
                        </ul>
                    </div>

                    <div class="col">
                        <h3>Hiver 2018</h3>
                        <ul>
                            <li><a href="{{ url('ift3150/chaffanet') }}">Paul-Philippe Chaffanet</a></li>
                            <li><a href="{{ url('ift3150/beauregard') }}">Vincent G. Beauregard</a></li>
                            <li><a href="{{ url('ift3150/labbe') }}">Émile Labbé</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
