<?php

include '../php_script_login/bd.php';

if(isset($_GET['token']) && $_GET['token'] != '')
{
    $stmt = $bdd->prepare('SELECT email FROM personnel WHERE token = ?');
    $stmt->execute([$_GET['token']]);
    $email = $stmt->fetchColumn();

    if($email) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Récuperation du mot de passe</title>
        </head>
        <body>
            <form method = 'POST'>
                <label for = "newPassword">Nouveau mot de passe</label>
                <input type = "password" name = "newPassword">
                <label for = "ConfirmPassword">Confirmer le nouveau mot de passe</label>
                <input type = "password" name = "newPassword2">
                <input type = "submit" value = "Confirmer">
            </form>
        </body>
        </html>
        <?php
    }
}

if(isset($_POST['newPassword']) && isset($_POST['newPassword2'])) {

    if($_POST['newPassword'] != $_POST['newPassword2']) {
        echo "Les mots de passe ne sont pas identiques";
    } else {
        $requet = $bdd->prepare('UPDATE personnel SET motDePasse = ?, token = NULL WHERE email = ?');
        $requet->execute([md5($_POST['newPassword']), $email]);
        echo "Mot de passe modifié avec succès";
    }
}
?>

