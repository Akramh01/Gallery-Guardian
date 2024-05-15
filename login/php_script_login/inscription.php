<?php

include 'bd.php';


if (isset($_POST['create'])) { // Vérifie si le formulaire a été soumis
    // var_dump($_POST);

    extract($_POST); // Extrait les valeurs de $_POST dans des variables

    $verif = $bdd->prepare("SELECT * FROM personnel WHERE idP = :id");
    $verif->execute(["id" => $id]);
    if ($verif->fetch()){
        header('Location: ../first_login.html?error=Ce compte éxiste dejà');
        exit();
    }
    else if (!$verif->fetch()){ // Correction ici : vérifie si le résultat est vide{

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Correction ici : hachage du mot de passe
        $requete = $bdd->prepare("INSERT INTO personnel (idP, NomP, PrenomP, DateN, MotDePasse, email) VALUES (:id, :nom, :prenom, :date, :password, :email)"); // Correction ici : parenthèses manquantes et correction de la syntaxe SQL
        $requete->execute([
            "id" => $id,
            "nom" => $nom,
            "prenom" => $prenom,
            "date" => $date,
            "email" => $email,
            "password" => $hashedPassword
        ]);
        // $reponse = $requete->fetchAll(PDO::FETCH_ASSOC); // Supprimé car inutile ici
        header('Location: ../login.html');
        exit();
        
    }
} else {
    echo "Aucun formulaire n'a été soumis";
}

?>
