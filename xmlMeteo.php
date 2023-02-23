<?php
$xmlApi = file_get_contents("https://www.infoclimat.fr/public-api/gfs/xml?_ll=" . $coordinates['lat'] . "," . $coordinates['lon'] . "&_auth=ARsDFFIsBCZRfFtsD3lSe1Q8ADUPeVRzBHgFZgtuAH1UMQNgUTNcPlU5VClSfVZkUn8AYVxmVW0Eb1I2WylSLgFgA25SNwRuUT1bPw83UnlUeAB9DzFUcwR4BWMLYwBhVCkDb1EzXCBVOFQoUmNWZlJnAH9cfFVsBGRSPVs1UjEBZwNkUjIEYVE6WyYPIFJjVGUAZg9mVD4EbwVhCzMAMFQzA2JRMlw5VThUKFJiVmtSZQBpXGtVbwRlUjVbKVIuARsDFFIsBCZRfFtsD3lSe1QyAD4PZA%3D%3D&_c=19f3aa7d766b6ba91191c8be71dd1ab2");
$xmlMeteo = simplexml_load_string($xmlApi);
if ($xmlMeteo->request_state == '200') {
    try {
        //formater le document
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;

        $dom->loadXML($xmlApi);

        // Ajouter le document formater dans le fichier meteo.xml
        $myfile = fopen("./xml/meteo.xml", "w");
        fwrite($myfile, $dom->saveXML());

        #region Code pas bo
        $xml = file_get_contents('./xml/meteo.xml');

        // trouver la position de la deuxième ligne
        $pos = strpos($xml, '<previsions>') - 1;

        // ajouter la nouvelle ligne de texte
        $xml = substr_replace($xml, "\n<!DOCTYPE previsions SYSTEM './meteo.dtd'>", $pos, 0);

        file_put_contents('./xml/meteo.xml', $xml);
        #endregion Code pas bo

    } catch (Exception $e) {
        echo 'Une erreur est survenue : ' . $e->getMessage();
    }
}