<?php

include 'bd.php';

// URL de l'API JSON pour récupérer les informations sur un périphérique
$request_url = 'http://192.168.4.1:8080/json.htm?type=devices&filter=all&used=true&order=Name&param=getdevices';



// Appel de l'API JSON
$json = file_get_contents($request_url);

// Décodage de la réponse JSON
$data = json_decode($json, true);

// Vérifie que la requête a réussi et que les données sont disponibles
if ($data['status']=='OK'&&isset(['result'][0]['Type'])) {

    $motion = $data['result'][0]['Usage'];
    $brightness = $data['result'][0]['Data'];
    $temperature = $data['result'][0]['Temp'];
    $last_update = $data['result'][0]['LastUpdate'];

     // Fait quelque chose avec les données récupérées, par exemple :
    echo "mouvement : ".$motion."<br>";
    echo "Luminosité : " . $brightness . "<br>";
    echo "Température : " . $temperature . "°C<br>";
    echo "Dernière mise à jour : " . $last_update;
} else {
     // La requête a échoué ou les données ne sont pas disponibles
     echo "Impossible de récupérer les données du capteur.";

}

?>