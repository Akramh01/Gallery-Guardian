<?php

include 'scriptPhpLogin/bd.php';

if(isset($_GET['token']) && $_GET['token']!='')
{
    $stmt = $bdd->prepare('SELECT email FROM personnel WHERE token = ?');
    $stmt->execute([$_GET['token']]);
    $email = $stmt->fetchColumn();

    if($email){
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Récuperation du mot de passe</title>
        </head>
        <body>
            <form methode = 'POST'>
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

?>