<?php

include '../DataBase/bd.php';

// URL de l'API JSON pour récupérer les informations sur un périphérique
$request_url = curl_init("http://192.168.4.1:8080/json.htm?type=devices&filter=all&used=true&order=Name&param=getdevices&rid=29");


curl_setopt($request_url, CURLOPT_RETURNTRANSFER, 1);
$output=curl_exec($request_url);


// Décodage de la réponse JSON
$data = json_decode($output, true);

// Vérifie que la requête a réussi et que les données sont disponibles
if ($data['status']=='OK') {

    if (isset($data['result'])) {
        $etat = "On";
        $temperature = $data['result'][0]['Data'];
        $id = $data['result'][0]['idx'];
        $last_update = $data['result'][0]['LastUpdate'];
        $name = $data['result'][0]['Name'];
        $type = $data['result'][0]['Type'];
        $elements = explode(" ", $last_update);
        $date = $elements[0];
        $heure = $elements[1];

        $verif = $bdd->prepare("SELECT idC from Capteur where idC=:id");
        $verif->execute(['id'=>$id]);

        if($verif->rowCount()==0){

            $request = $bdd->prepare("INSERT INTO Capteur (idC, etatC, temperatureAir, type, nom, date, heure)
            VALUES (:id, :etat, :temperature, :type, :name, :date, :heure)");
            $request->execute([
                'id' => $id,
                'etat' => $etat,
                'temperature' => $temperature,
                'type' => $type,
                'name' => $name,
                'date' => $date,
                'heure' => $heure
            ]);
        }else if ($verif->rowCount()>0){
            $request = $bdd->prepare("UPDATE Capteur SET temperatureAir = :temperature, date = :date, heure = :heure WHERE idC = :id");
            $request->execute([
                'temperature' => $temperature,
                'date' => $date,
                'heure' => $heure,
                'id' => $id
            ]);
        }

    } else {
        $etat = "Off";

        $verif = $bdd->prepare("SELECT idDP FROM Capteur WHERE idDP = :id");
        $verif->execute(['id'=>$id]);

        if($verif->countRow()==0){
            $reuqest = $bdd->prepare("INSERT INTO Capteur (idDP, Etat)
             VALUES (:id, :etat)");
            $request->execute([
                'id' => $id,
                'etat' => $etat
            ]);
        }else{
            $request = $bdd->prepare("UPDATE Capteur set Etat = :etat WHERE idDP = :id");
            $request->execute([
                'etat' => $etat,
                'id' => $id
            ]);
        }
    }

    

} else {
     // La requête a échoué ou les données ne sont pas disponibles
     echo "Impossible de récupérer les données du capteur.";

}

?>