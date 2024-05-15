<?php

$servername = "192.168.4.1"; //192.168.4.1 pour le raspberry
$username = "phpmyadmin"; //username dans le raspberry sera different
$pass = "tp"; //password dans le raspberry sera different

//Connexion à la base de donnée
try{
            
    $bdd = new PDO("mysql:host=$servername;dbname=gallery-guardian", $username, $pass);
    
    //connexion a la base de donnees, dbname pour le nom de la base de donnée que je n'ai pas encore mit
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //spécifier le type d'erreur
    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

?>