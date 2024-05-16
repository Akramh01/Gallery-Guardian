<?php
$servername = "localhost";
$username = "phpmyadmin"; //phpmyadmin dans le raspberry
$pass = "tp"; //tp dans le raspberry

//Connexion à la base de donnée
try{
            
    $bdd = new PDO("mysql:host=$servername;dbname=GalleryGuardian", $username, $pass);
    
    //connexion a la base de donnees, dbname pour le nom de la base de donnée que je n'ai pas encore mit
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //spécifier le type d'erreur
    echo "Connected successfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

?>