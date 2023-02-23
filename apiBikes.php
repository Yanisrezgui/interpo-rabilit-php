<?php
try {
   
    $bike=json_decode(file_get_contents("https://api.jcdecaux.com/vls/v3/stations?apiKey=frifk0jbxfefqqniqez09tw4jvk37wyf823b5j1i&contract=nancy"));
    $jsonArray=array();
    foreach($bike as $bikes){
        $dataStation = array(
            "id" => $bikes->number,
            "capacity" => $bikes->totalStands->capacity,
            "lat" => $bikes->position->latitude,
            "lon" => $bikes->position->longitude,
            "name" => $bikes->name,
            "address"=>$bikes->address,
            "status"=>$bikes->status,
        );
        array_push($jsonArray, $dataStation);
    }
    $myfile = fopen("./bikes.json", "w");
    fwrite($myfile, json_encode($jsonArray, JSON_PRETTY_PRINT));
} catch (Exception $e) {
    echo 'Une erreur est survenue : ' . $e->getMessage();
}