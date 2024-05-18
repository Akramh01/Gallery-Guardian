<?php

include 'bd.php';

// URL de l'API JSON pour récupérer les informations sur un périphérique
$request_url = curl_init("http://192.168.4.1:8080/json.htm?type=devices&filter=all&used=true&order=Name&param=getdevices&rid=32");


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
        $uv = $data['result'][0]['Data'];
        $elements = explode(" ", $last_update);
        $date = $elements[0];
        $heure = $elements[1];

        $verif = $bdd->prepare("SELECT idC from Capteur where idC=:id");
        $verif->execute(['id'=>$id]);

        if($verif->rowCount()==0){

            $request = $bdd->prepare("INSERT INTO Capteur (idC, etatC, uv, type, nom, date, heure)
            VALUES (:id, :etat, :uv, :type, :name, :date, :heure)");
            $request->execute([
                'id' => $id,
                'etat' => $etat,
                'uv' => $uv,
                'type' => $type,
                'name' => $name,
                'date' => $date,
                'heure' => $heure
            ]);
        }else if ($verif->rowCount()>0){
            echo "salut : ".$id;
            $request = $bdd->prepare("UPDATE Capteur SET uv = :uv, date = :date, heure = :heure WHERE idC = :id");
            $request->execute([
                'uv' => $uv,
                'date' => $date,
                'heure' => $heure,
                'id' => $id
            ]);
        }
       
    } else {
        $etat = "Off";
    }
    

} else {
     // La requête a échoué ou les données ne sont pas disponibles
     echo "Impossible de récupérer les données du capteur.";

}

?>
