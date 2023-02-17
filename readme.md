# Intérpérabilité - Projet #
### ♬ À bicyclette ♪.. Une page php croisant des API ###

## Sujet ## 

Construire une page html à partir de votre géolocalisation ip.
Générer, à partir d'une page php, une page html, hébergée sur webetu, qui, à partir des réponses en xml des différentes API :

    Géolocalise l'adresse IP du client (attention à ce que ce soit bien le client, la géolocalisation du serveur n'ayant aucun intérêt), si la géolocalisation de l'adresse IP n'aboutit pas sur nancy, récupérer, par une API, les coordonnées de l'iut Charlemagne.

    Dans une première partie de la page, récupère lesdonnées météo, à partir de la réponse à lagéolocalisation, génére le fragment html à l'aidede la feuille XSL demandée dans le préalable, etinclut ce fragment dans la page générée.

    Dans une seconde partie de la page, affiche unecarte Leaflet plaçant la position du client etcentrée sur cette position, obtenue toujours avecla géolocalisation. Cette carte indiquera les lieuxdes différents parkings velolib de Nancy. Lespopups indiquant les parking à vélos indiqueront lenombre de places libres et le nombre de vélosdisponibles, au moment du chargement de la page.

    Suite au changement de l'APi des vélos, vousutliserez ces ressources, avec la fonctionjson_decode . curl, curlgetinfo et CURLOPT_PROXYpeuvent remplacer file_get_content. en cas d'erreur400.

    Intégrer dans cette page une information sur laqualité de l'air du jour....

    Ajouter une position en fonction d'une adresse àvotre carte (votre adresse, l'iut, la gare ouautre). 


**Projet réalisé par :** \
Welfringer Damien \
Jund Damien