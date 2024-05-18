<?php

include 'bd.php';

// URL de l'API JSON pour récupérer les informations sur un périphérique
$request_url = curl_init("http://192.168.4.1:8080/json.htm?type=devices&filter=all&used=true&order=Name&param=getdevices&rid=37");


curl_setopt($request_url, CURLOPT_RETURNTRANSFER, 1);
$output=curl_exec($request_url);


// Décodage de la réponse JSON
$data = json_decode($output, true);

// Vérifie que la requête a réussi et que les données sont disponibles
if ($data['status']=='OK') {


    if (isset($data['result'])) {
        $etat = "On";
        $id = $data['result'][0]['idx'];
        $last_update = $data['result'][0]['LastUpdate'];
        $name = $data['result'][0]['Name'];
        $type = $data['result'][0]['Type'];
        $etatP = $data['result'][0]['Data'];
    
    } else {
        $etat = "Off";
    }

    if($etatP=="Off") {
        echo "porte fermée";
    }else {
        echo "Porte ouverte";
    }

} else {
     // La requête a échoué ou les données ne sont pas disponibles
     echo "Impossible de récupérer les données du capteur.";

}

?>