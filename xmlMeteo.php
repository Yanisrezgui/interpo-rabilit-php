<?php
$xmlMeteo = simplexml_load_string(file_get_contents("https://www.infoclimat.fr/public-api/gfs/xml?_ll=" . $coordinates['lat'] . "," . $coordinates['lon'] . "&_auth=ARsDFFIsBCZRfFtsD3lSe1Q8ADUPeVRzBHgFZgtuAH1UMQNgUTNcPlU5VClSfVZkUn8AYVxmVW0Eb1I2WylSLgFgA25SNwRuUT1bPw83UnlUeAB9DzFUcwR4BWMLYwBhVCkDb1EzXCBVOFQoUmNWZlJnAH9cfFVsBGRSPVs1UjEBZwNkUjIEYVE6WyYPIFJjVGUAZg9mVD4EbwVhCzMAMFQzA2JRMlw5VThUKFJiVmtSZQBpXGtVbwRlUjVbKVIuARsDFFIsBCZRfFtsD3lSe1QyAD4PZA%3D%3D&_c=19f3aa7d766b6ba91191c8be71dd1ab2"));

if ($xmlMeteo->request_state == '200') {
    try {
        $xmlMeteo->asXML("meteo.xml");
    } catch (Exception $e) {
        echo 'Une erreur est survenue : ' . $e->getMessage();
    }
}
