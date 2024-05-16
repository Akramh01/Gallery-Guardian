<?php

include 'bd.php';


$domoticz_url = "http://localhost:8080/json.htm";

$device = "25";

$request_url = $domitcz_url."?type=device&rid=".$devices;


// Appel de l'API JSON
$json = file_get_contents($request_url);

// Décodage de la réponse JSON
$data = json_decode($json, true);




?>