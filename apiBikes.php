<?php
try {
    $bikeInformation = json_decode(file_get_contents("https://transport.data.gouv.fr/gbfs/nancy/station_information.json"));
    $bikeStatus = json_decode(file_get_contents("https://transport.data.gouv.fr/gbfs/nancy/station_status.json"));
    
    $jsonArray = array();
    foreach ($bikeStatus->data->stations as &$status) {
        $stationId = $status->station_id;

        //get bikes and docks available corresponding with stationId
        foreach ($bikeInformation->data->stations as &$info) {
            if ($info->station_id === $stationId) {
                $dataStation = array(
                    "address" => $info->address,
                    "capacity" => $info->capacity,
                    "lat" => $info->lat,
                    "lon" => $info->lon,
                    "name" => $info->name,
                    "num_bikes_available" => $status->num_bikes_available,
                    "num_docks_available" => $status->num_docks_available
                );

                array_push($jsonArray, $dataStation);
            }
        }
    }
    
    $myfile = fopen("./bikes.json", "w");
    fwrite($myfile, json_encode($jsonArray, JSON_PRETTY_PRINT));
} catch (Exception $e) {
    echo 'Une erreur est survenue : ' . $e->getMessage();
}
