<?php
include '../DataBase/bd.php';

$capteur = $bdd->prepare("SELECT * FROM Capteur");
$capteur->execute();

$porte = $bdd->prepare("SELECT * FROM DetecteurPorte");
$porte->execute();

$time_stamp = time();
$date = date("Y-m-d", $time_stamp);
$heure = date("H:i:s", $time_stamp);

function random ($length = 3){
    $ch = 'AZERTYUIOPQSDFGHJKLMWXCVBN123456789';
    $lt = '123456789';
    $random = '';

    for ($i = 0; $i < $length; $i++) {
        $random .= $ch[rand(0, strlen($ch) - 1)];
    }
    for ($i = 0; $i < $length; $i++) {
        $random .= $lt[rand(0, strlen($lt) - 1)];
    }

    return $random;
}

//Parcourir les résultats
while ($row = $capteur->fetch(PDO::FETCH_ASSOC)) {
    if (preg_match('/[-+]?[0-9]*\.?[0-9]+/', $row["Temperature"], $matches)) {
        $temperature = floatval($matches[0]);

        // Vérifier si la température est supérieure à 30
        if ($temperature > 30) {
            do {
                $id = random();
                $verif = $bdd->prepare("SELECT idEvent from Evenement where idEvent=:id");
                $verif->execute(['id'=>$id]);
            }while($verif->rowCount()>0);

            $type ="Température trop élevé : ".$temperature."C°";
            $nv = "Elevé";

            $request = $bdd->prepare("INSERT INTO Evenement (idEvent, DateE, Heure, TypeE, NvAlerte) VALUES (?,?,?,?,?)");
            $request->execute([$id, $date, $heure, $type, $nv]);

        }
    }

    if (preg_match('/[-+]?[0-9]*\.?[0-9]+/', $row["temperatureAir"], $matches)) {

        $temperature = floatval($matches[0]);
        if ($temperature > 30) {
         
            do {
                $id = random();
                $verif = $bdd->prepare("SELECT idEvent from Evenement where idEvent=:id");
                $verif->execute(['id'=>$id]);
            }while($verif->rowCount()>0);

            $type ="Température de l'air trop élevé : ".$temperature."C°";
            $nv = "Moyen";

            $request = $bdd->prepare("INSERT INTO Evenement (idEvent, DateE, Heure, TypeE, NvAlerte) VALUES (?,?,?,?,?)");
            $request->execute([$id, $date, $heure, $type, $nv]);
        }

    }

    if (preg_match('/[-+]?[0-9]*\.?[0-9]+/', $row["illuminance"], $matches)){

        $illuminance = floatval($matches[0]);

        if ($illuminance > 200) {
            do {
                $id = random();
                $verif = $bdd->prepare("SELECT idEvent from Evenement where idEvent=:id");
                $verif->execute(['id'=>$id]);
            }while($verif->rowCount()>0);

            $type ="Luminosité trop élevé : ".$illuminance." lux";
            $nv = "Elevé";

            $request = $bdd->prepare("INSERT INTO Evenement (idEvent, DateE, Heure, TypeE, NvAlerte) VALUES (?,?,?,?,?)");
            $request->execute([$id, $date, $heure, $type, $nv]);
        }
    }

    if (preg_match('/[-+]?[0-9]*\.?[0-9]+/', $row["humidite"], $matches)){
        $humidite = floatval($matches[0]);

        if ($humidite > 90) {
            do {
                $id = random();
                $verif = $bdd->prepare("SELECT idEvent from Evenement where idEvent=:id");
                $verif->execute(['id'=>$id]);
            }while($verif->rowCount()>0);

            $type ="Humidité trop élevé : ".$humidite." %";
            $nv = "Faible";

            $request = $bdd->prepare("INSERT INTO Evenement (idEvent, DateE, Heure, TypeE, NvAlerte) VALUES (?,?,?,?,?)");
            $request->execute([$id, $date, $heure, $type, $nv]);
        }
    }

    if ($row['EtatC']=="Off") {
        do {
            $id = random();
            $verif = $bdd->prepare("SELECT idEvent from Evenement where idEvent=:id");
            $verif->execute(['id'=>$id]);
        }while($verif->rowCount()>0);

        $type ="Multisensor eteint";
        $nv = "Urgent";

        $request = $bdd->prepare("INSERT INTO Evenement (idEvent, DateE, Heure, TypeE, NvAlerte) VALUES (?,?,?,?,?)");
        $request->execute([$id, $date, $heure, $type, $nv]);
    }

}

while ($row = $porte->fetch(PDO::FETCH_ASSOC)){

    if (preg_match('/[-+]?[0-9]*\.?[0-9]+/', $row["temperature"], $matches)) {
        $temperature = floatval($matches[0]);
        if ($temperature > 30) {
            do {
                $id = random();
                $verif = $bdd->prepare("SELECT idEvent from Evenement where idEvent=:id");
                $verif->execute(['id'=>$id]);
            }while($verif->rowCount()>0);

            $type ="Température du capteur trop élevé : ".$temperature."C°";
            $nv = "Elevé";

            $request = $bdd->prepare("INSERT INTO Evenement (idEvent, DateE, Heure, TypeE, NvAlerte) VALUES (?,?,?,?,?)");
            $request->execute([$id, $date, $heure, $type, $nv]);

        }
    }
    if ($row['SignalDP']=="On") {
            do {
                $id = random();
                $verif = $bdd->prepare("SELECT idEvent from Evenement where idEvent=:id");
                $verif->execute(['id'=>$id]);
            }while($verif->rowCount()>0);

            $type ="Porte ouverte";
            $nv = "Elevé";

            $request = $bdd->prepare("INSERT INTO Evenement (idEvent, DateE, Heure, TypeE, NvAlerte) VALUES (?,?,?,?,?)");
            $request->execute([$id, $date, $heure, $type, $nv]);

    }

    if ($row['Etat']=="Off") {
        do {
            $id = random();
            $verif = $bdd->prepare("SELECT idEvent from Evenement where idEvent=:id");
            $verif->execute(['id'=>$id]);
        }while($verif->rowCount()>0);

        $type ="Detecteur de porte eteint";
        $nv = "Urgent";

        $request = $bdd->prepare("INSERT INTO Evenement (idEvent, DateE, Heure, TypeE, NvAlerte) VALUES (?,?,?,?,?)");
        $request->execute([$id, $date, $heure, $type, $nv]);
    }

}

?>