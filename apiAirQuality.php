<?php
$opts =  array('http' => array('proxy' => 'tcp://www-cache:3128', 'request_fulluri' => true), 'ssl' => array('verify_peer' => false, 'verify_peer_name' => false));
$context = stream_context_create($opts);
stream_context_set_default($opts); 

try {
    $airQualities = json_decode(file_get_contents("https://services3.arcgis.com/Is0UwT37raQYl9Jj/arcgis/rest/services/ind_grandest/FeatureServer/0/query?where=lib_zone%3D%27Nancy%27&objectIds=&time=&geometry=&geometryType=esriGeometryEnvelope&inSR=&spatialRel=esriSpatialRelIntersects&resultType=none&distance=0.0&units=esriSRUnit_Meter&returnGeodetic=false&outFields=*&returnGeometry=true&featureEncoding=esriDefault&multipatchOption=xyFootprint&maxAllowableOffset=&geometryPrecision=&outSR=&datumTransformation=&applyVCSProjection=false&returnIdsOnly=false&returnUniqueIdsOnly=false&returnCountOnly=false&returnExtentOnly=false&returnQueryGeometry=false&returnDistinctValues=false&cacheHint=false&orderByFields=&groupByFieldsForStatistics=&outStatistics=&having=&resultOffset=&resultRecordCount=&returnZ=false&returnM=false&returnExceededLimitFeatures=true&quantizationParameters=&sqlFormat=none&f=pjson&token=", true, $context));
    
    $currentTime = floor(microtime(true) * 1000);
    $closestTime = 0;
    $smallestDiff = PHP_INT_MAX;

    $jsonArray = array();
    foreach ($airQualities->features as &$airQuality) {
        $airQualityTime = $airQuality->attributes->date_ech;
        $diff = abs($currentTime - $airQualityTime);
        
        if ($diff <= $smallestDiff) {
            $closestTime = $airQualityTime;
            $smallestDiff = $diff;
        }
    }

    foreach ($airQualities->features as &$airQuality) {
        if ($airQuality->attributes->date_ech === $closestTime) {
            $dataStation = array(
                "lib_qual" => $airQuality->attributes->lib_qual,
                "x" => $airQuality->geometry->x,
                "y" => $airQuality->geometry->y,
            );
    
            array_push($jsonArray, $dataStation);
        }
    }

    $myfile = fopen("./airQuality.json", "w");
    fwrite($myfile, json_encode($jsonArray, JSON_PRETTY_PRINT));
} catch (Exception $e) {
    echo 'Une erreur est survenue : ' . $e->getMessage();
}