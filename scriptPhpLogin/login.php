<?php

include 'bd.php';

//var_export($_SERVER);

if($_SERVER["REQUEST_METHOD"] == "POST") {

    extract($_POST); //extract $_POST values into variables


    if($id != "" && $password != "") {
        //Connexion à la base de donnée
        
        $requet = $bdd->prepare("SELECT * FROM personnel WHERE idP = :id and MotDePasse = :password");
        $requet->execute(
            array(
                "id" => $id,
                "password" => $password
            )
            );
        $rep = $requet->fetch();


        if($requet->rowCount() == 1) {
            // je renvoie vers la page d'accueil
            header('Location: ../firstLogin.html');
            exit();
        } else {
            header('Location: ../login.html?error=Identifiant ou mot de passe incorrect !');
            exit();
        }


    }
}


?>