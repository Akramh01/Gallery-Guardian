<?php

$servername = "localhost"; //192.168.4.1 pour le raspberry
$username = "root"; //username dans le raspberry sera different
$password = ""; //password dans le raspberry sera different

if($_SERVER("REQUEST_METHOD") == "POST") {

    extract($_POST); //extract $_POST values into variables

    if($id != "" && $password != "") {
        //Connexion à la base de donnée
        try{
            $bdd = new PDO("mysql::host=$servername; dbname = gallery-guardian", $username, $password);
            //connexion a la base de donnees, dbname pour le nom de la base de donnée que je n'ai pas encore mit
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //spécifier le type d'erreur
            echo "Connected successfully";
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        
        $requet = $bdd->prepare("SELECT * FROM personnel WHERE idP = :id and MotDePasse = :password");
        $requet = $bdd->execute(
            array(
                "id" => $id,
                "password" => $password
            )
            );
        $rep = $requet->fetch();
        if($requet->rowCount() == 1) {
            // je renvoie vers la page d'accueil
            header('Location: #');
            exit();
        }else {
            $error_msg = "identifiant ou mot de passe incorrect !";
            ?>
            <p style = "color:red"><?php echo $error_msg; ?></p>
            <?php
        }

    }
}


?>