<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre site internet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel = "stylesheet" type = "text/css" href = "style.css">
</head> 

<body>
    <label>
      <input type="checkbox">
      <div class="toggle">
        <span class="top_line common"></span>
        <span class="middle_line common"></span>
        <span class="bottom_line common"></span>
      </div>

      <div class = "slide">
        <h1>MENU</h1>
        <ul>
          <li><a href = '#'><i class = "fas fa-user"></i> Profile </a></li>
          <li><a href = '#'><i class = "far fa-address-book"></i> Télécommande </a></li>
          <li><a href = '#'><i class = "fas fa-tv"></i> Oeuvre d'art </a></li>
          <li><a href = '#'><i class = "fas fa-comments"></i> Events </a></li>

        </ul>
      </div>
    </label>
    <div class = "section2">
        <div class="text2" >
            <h4 class="front-title">Oeuvre</h4>
        
            <img src="img.jpeg" alt="Oeuvre d'art" class="centered-image">
        </div>
        <div class="table-container">
        <!-- Container pour le tableau 'Remote' -->
            <div class="remote-table">
                <h2>Remote</h2>
            <table>
                <thead>
                    <tr>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Les données PHP seront générées ici -->
                    <?php include 'remote.php'; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Container pour le tableau 'Alerte' -->
        <div class="alert-table">
            <h2>Alerte !</h2>
            <table>
                <thead>
                    <tr>
                        <th>Notifications</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
// Inclusion du fichier de connexion à la base de données
include 'bd.php';

// Requête SQL pour afficher les derniers événements
$sql = "SELECT * FROM Evenement ORDER BY idEvent DESC LIMIT 9";

try {
$result = $bdd->query($sql);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['NvAlerte']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>Aucun résultat trouvé</td></tr>";
}        
} catch (Exception $e) {
echo "<tr><td colspan='3'>Erreur : " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}

// Fermeture de la connexion
$bdd = null;
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer> 
</body>
</html>
