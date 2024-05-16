

<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre site internet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="oeuv.css">
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
    </label>
    
    <div class="container">
      <div class="table-container">
        <h4>Des informations</h4>
        <table border="1">
          <thead>
            <tr>
              <th>Num oeuvre</th>
              <th>Emplacement</th>
              <th>Nom du musée</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include 'bd.php';  // Assurez-vous que ce fichier configure la connexion PDO
            try {
                $requete = "SELECT O.idOeuvre as Num oeuvre,O.Emplacement as Emplacement, Nom as Nom du Musee
                FROM Oeuvreart O, Musee M
                WHERE O.idMusee = M.idMusee";
                $resultat = $bdd->query($requete);

                if ($resultat->rowCount() == 0) {
                  echo "<tr><td colspan='2'>Aucune ligne ne correspond</td></tr>";
                } else {
                  while ($ligneResultat = $resultat->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($ligneResultat["idOeuvre"]) . "</td>";
                    echo "<td>" . htmlspecialchars($ligneResultat["NumSalle"]) . "</td>";
                    echo "</tr>";
                  }
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='2'>Erreur dans l'exécution de la requête : " . $e->getMessage() . "</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="image-container">
      <h2>Plan de musée</h2>
      <img src="R.jpeg" alt="Plan du musée">
    </div>

    <footer>
      <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
  </body>
  </html>