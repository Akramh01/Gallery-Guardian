<?php

$servername = "localhost"; //192.168.4.1 pour le raspberry
$username = "root"; //username dans le raspberry sera different
$password = ""; //password dans le raspberry sera different

try{
    $bdd = new PDO("mysql::host=$servername; dbname = gallery-guardian", $username, $password);
    //connexion a la base de donnees, dbname pour le nom de la base de donnée que je n'ai pas encore mit
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //spécifier le type d'erreur
    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

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