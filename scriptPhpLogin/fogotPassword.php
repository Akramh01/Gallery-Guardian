<?php
include 'bd.php';

if(isset($_POST['email'])){

    $token = uniqid();
    $url = "http://localhost/Gallery-Guardian/token?token=$token.php";

    $message = "Bonjour, voici votre lien pour la réintialisation de votre mot de passe : $url";

    
}


?>