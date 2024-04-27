<?php

include 'bd.php';

function generateRandomString($length, $bdd) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    do {
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $requete = $bdd->prepare("SELECT id FROM personnel where id = :id");
        $requete->execute([':id' => $randomString]);
    }while (empty($requete->fetch()));
    return $randomString;
}

$id = generateRandomString(6, $bdd);

if(isset($_POST['create'])) { //check if form was submitted
    // var_dump($_POST);

    extract($_POST); //extract $_POST values into variables

    $verif = $bdd->prepare("SELECT * FROM personnel where nomP = :nom and PrenomP = :prenom and DateN = :date");
    $verif->execute(
        array(
            "nom" => $nom,
            "prenom" => $prenom,
            "date" => $date
        )
        );
        if(empty($verif->fetch())) {
            $requete = $bdd->prepare("INSERT INTO personnel(idP, NomP, PrenomP, DateN, MotDePasse)
             VALUES (:id, :nom, :prenom, :date, MD5(:password)");
            $requete->execute(
            array(
                "id" => id,
                "nom" => $nom,
                "prenom" => $prenom,
                "date" => $date,
                "password" => $password
            )
            );
            $reponse = $requete->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            ?>
            <h1>Vous êtes deja inscrit</h1>
            <?php
            header('Location: login.html');
            exit();
        }
}
else {
    echo "No form was submitted";
}

?>