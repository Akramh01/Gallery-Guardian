<?php

include 'bd.php';

$capteur = $bdd->prepare("SELECT * FROM Capteur");
$capteur->execute();

//Parcourir les résultats
while ($row = $capteur->fetch(PDO::FETCH_ASSOC)) {
    //Vérifier si la température est supérieur à 40C°
    $temperature_str = $row['Temperature'];
    $temperature_clean = preg_replace('/[^0-9.]/', '', str_replace(',', '.', $temperature_str));
    $temperature = floatval($temperature_clean);

    if ($temperature >= 5) {
        echo $temperature;
    }
}
?>