<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
        crossorigin=""/>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://kit.fontawesome.com/207603d2ea.js" crossorigin="anonymous"></script>
    <title>♬ À bicyclette ♪.. Une page php croisant des API</title>
</head>
<body>
    <div id="map"></div>
    <div id="search-bar">
        <div class="wrap">
            <div class="search">
                <input type="text" class="searchTerm" placeholder="Rechecher une adresse">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        </div>
    <?php require_once('./xmlLoadingPage.php') ?>

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
    crossorigin=""></script>
<script type="text/javascript" src="./map.js"></script>
</body>
</html>