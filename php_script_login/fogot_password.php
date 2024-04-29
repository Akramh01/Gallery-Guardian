<?php
include 'bd.php';

if(isset($_POST['email'])) {
    $token = uniqid();
    
    $url = "http://localhost/Gallery-Guardian/token/index.php?token=$token";
   
    // Afficher l'URL pour vérifier qu'elle est correcte
    echo "URL générée : " . $url . "<br>";

    $message = "Bonjour, voici votre lien pour la réintialisation de votre mot de passe : $url";
    $header = 'Content-type: text/html; charset="utf-8"'." ";

    #envoie du mail
    if(mail($_POST['email'], "Reinitialisation du mot de passe", $message, $header))
    {
        $sql = "UPDATE personnel SET token = :token WHERE email = :email";
        $requet = $bdd->prepare($sql);
        $requet->execute(
            array(
                "token" => $token,
                "email" => $_POST['email']
            )
            );
        echo "Un mail vous a été envoyé à l'adresse suivante : " . $_POST['email'];
    }
    else
    {
        echo "Une erreur est survenue";
    }
}