<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="60">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre site internet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="wstyle.css">
    <link rel="stylesheet" type="text/css" href="pourmenu.css">
  
</head>
<body>
    <label>
        <input type="checkbox">
        <div class="toggle">
            <span class="top_line common"></span>
            <span class="middle_line common"></span>
            <span class="bottom_line common"></span>
        </div>
        <div class="slide">
            <h1>MENU</h1>
            <ul>
                <li><a href='#'><i class="fas fa-user"></i> Profile </a></li>
                <li><a href='#'><i class="far fa-address-book"></i> Télécommande </a></li>
                <li><a href='#'><i class="fas fa-tv"></i> Oeuvre d'art </a></li>
                <li><a href='#'><i class="fas fa-comments"></i> Events </a></li>
            </ul>
        </div>



        <!-- Le header -->
        
        <div class="header">
            <img src="assets/Logo.png" alt="Logo" width="10" height="10">
            <h1>GalleryGuardian</h1>
         
            </div>
          

            <!-- la fin du header -->

    

        <div class="containerEvent">
            <div class="titre">
            <h2 >Alertes !!!</h2>
            </div>
            <table class="center-table">
                <thead>
                    <tr>
                        <th>ID de l'événement</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Type d'événement</th>
                        <th>Niveau d'alerte</th>
                    </tr>
                </thead>
                <tbody>


                <?php
        // Inclusion du fichier de connexion à la base de données
        include 'bd.php';
        // Requête SQL pour afficher les derniers événements
        $sql = "SELECT * FROM Evenement ORDER BY idEvent DESC LIMIT 5";
        try {
            $result = $bdd->query($sql);
            
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["idEvent"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["DateE"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["Heure"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["TypeE"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["NvAlerte"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun résultat trouvé</td></tr>";
            }        
        } catch (Exception $e) {
            echo "<tr><td colspan='5'>Erreur : " . htmlspecialchars($e->getMessage()) . "</td></tr>";
        }

        $bdd = null;//Fermeture de la connexion
        ?>
                </tbody>
            </table>
        </div>
    </label>
    <footer class="footer">
       <!-- <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p> -->
    </footer>
</body>
</html> 