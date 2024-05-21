<?php

include '../DataBase/bd.php';

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
        $etatP = $data['result'][0]['Data'];
        $elements = explode(" ", $last_update);
        $date = $elements[0];
        $heure = $elements[1];

        
        $verif = $bdd->prepare("SELECT idDP FROM DetecteurPorte WHERE idDP = :id");
        $verif->execute(['id'=>$id]);


        if($verif->rowCount()==0) {

            $request = $bdd->prepare("INSERT INTO DetecteurPorte (idDP, SignalDP, Etat, date, heure)
             VALUES (:id, :signal, :etat, :date, :heure)");
            
            $request->execute([
                'id' => $id,
                'signal' => $etatP,
                'etat' => $etat,
                'date' => $date,
                'heure' => $heure
            ]);
        }else {
            $request = $bdd->prepare("UPDATE DetecteurPorte set
             SignalDP = :signal, Etat = :etat, date = :date, heure = :heure WHERE idDP = :id");
            $request->execute([
                'signal' => $etatP,
                'etat' => $etat,
                'date' => $date,
                'heure' => $heure,
                'id' => $id
            ]);
        }

    } else {
        $etat = "Off";

        $verif = $bdd->prepare("SELECT idDP FROM DetecteurPorte WHERE idDP = :id");
        $verif->execute(['id'=>$id]);

        if($verif->rowCount()==0){
            $reuqest = $bdd->prepare("INSERT INTO DetecteurPorte (idDP, Etat)
             VALUES (:id, :etat)");
            $request->execute([
                'id' => $id,
                'etat' => $etat
            ]);
        }else{
            $request = $bdd->prepare("UPDATE DetecteurPorte set Etat = :etat WHERE idDP = :id");
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