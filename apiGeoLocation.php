<?php
 $opts =  array('http' => array('proxy' => 'tcp://www-cache:3128', 'request_fulluri' => true), 'ssl' => array('verify_peer' => false, 'verify_peer_name' => false));
 $context = stream_context_create($opts);
 stream_context_set_default($opts); 

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipClient = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipClient = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ipClient = $_SERVER['REMOTE_ADDR'];
}

$apiGeoLocalisation = json_decode(file_get_contents("http://ip-api.com/json/" . $ipClient . "?fields=status,country,city,lat,lon,query",true,$context));

if ($apiGeoLocalisation->status != "fail") {
    $lat = $apiGeoLocalisation->lat;
    $lon = $apiGeoLocalisation->lon;
} else {
    $geoLocalisationIUT = json_decode(file_get_contents("https://api-adresse.data.gouv.fr/search/?q=Boulevard%20Charlemagne%2054000%20Nancy"));
    $lat = $geoLocalisationIUT->features[0]->geometry->coordinates[1];
    $lon = $geoLocalisationIUT->features[0]->geometry->coordinates[0];
}

$coordinates = array("lat" => $lat, "lon" => $lon);
?>

<script>
localStorage.setItem('coordinates', JSON.stringify(<?php echo json_encode($coordinates); ?>));
</script>