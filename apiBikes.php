<?php
try {
   
    $bikes = json_decode(file_get_contents("https://api.jcdecaux.com/vls/v3/stations?apiKey=frifk0jbxfefqqniqez09tw4jvk37wyf823b5j1i&contract=nancy"));
    
    $jsonArray = array();
    foreach($bikes as $bike){
        $dataStation = array(
            "address" => $bike->address,
            "lat" => $bike->position->latitude,
            "lon" => $bike->position->longitude,
            "capacity" => $bike->mainStands->capacity,
            "bikes" => $bike->mainStands->availabilities->bikes,
            "stands" => $bike->mainStands->availabilities->stands,
            "status"=>$bike->status,
        );

        array_push($jsonArray, $dataStation);
    }
    $myfile = fopen("./bikes.json", "w");
    fwrite($myfile, json_encode($jsonArray, JSON_PRETTY_PRINT));
} catch (Exception $e) {
    echo 'Une erreur est survenue : ' . $e->getMessage();
}