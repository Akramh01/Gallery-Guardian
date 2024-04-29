<?php

include 'bd.php';

function generateRandomString($length, $bdd)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters_length = strlen($characters);
    $random_string = '';
    do {
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, $characters_length - 1)];
        }
        $requete = $bdd->prepare("SELECT id FROM personnel where id = :id");
        $requete->execute([':id' => $random_string]);
    }while (empty($requete->fetch()));
    return $random_string;
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
        if(empty($verif->fetch()))
        {
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
        else
        {
            ?>
            <h1>Vous êtes deja inscrit</h1>
            <?php
            header('Location: ../login.html');
            exit();
        }
}
else
{
    echo "No form was submitted";
}

?>