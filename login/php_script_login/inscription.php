<?php

include 'bd.php';

// function generateRandomString($length, $bdd)
// {
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $characters_length = strlen($characters);
//     $random_string = '';
//     do {
//         for ($i = 0; $i < $length; $i++) {
//             $random_string .= $characters[rand(0, $characters_length - 1)];
//         }
//         $requete = $bdd->prepare("SELECT id FROM personnel WHERE id = :id");
//         $requete->execute([':id' => $random_string]);
//     } while ($requete->fetch()); // Correction ici : condition inversée
//     return $random_string;
// }

// $id = generateRandomString(6, $bdd);

if (isset($_POST['create'])) { // Vérifie si le formulaire a été soumis
    // var_dump($_POST);

    extract($_POST); // Extrait les valeurs de $_POST dans des variables

    $verif = $bdd->prepare("SELECT * FROM personnel WHERE NomP = :nom AND PrenomP = :prenom AND DateN = :date");
    $verif->execute([
        "nom" => $nom,
        "prenom" => $prenom,
        "date" => $date
    ]);
    if (!$verif->fetch()){ // Correction ici : vérifie si le résultat est vide{

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
        
    } else {
        ?>
        <h1>Vous êtes déjà inscrit</h1>
        <?php
        header('Location: ../login.html');
        exit();
    }
} else {
    echo "Aucun formulaire n'a été soumis";
}

?>
