

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
  <div class="search-container">
        <form action="search.php" method="GET">
            <input type="text" placeholder="Rechercher..." name="search" class="search-input" required>
            <button type="submit" class="search-button">Recherche</button>
        </form>
    </div>
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
              $requete = "SELECT O.idOeuvre as `Num oeuvre`, O.Emplacement as Emplacement, M.Nom as `Nom du Musee`
              FROM Oeuvreart O, Musee M
              WHERE O.idMusee = M.idMusee";
              
              $resultat = $bdd->query($requete);

              if ($resultat->rowCount() == 0) {
                echo "<tr><td colspan='3'>Aucune ligne ne correspond</td></tr>";
              } else {
                while ($ligneResultat = $resultat->fetch(PDO::FETCH_ASSOC)) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($ligneResultat["Num oeuvre"]) . "</td>";
                  echo "<td>" . htmlspecialchars($ligneResultat["Emplacement"]) . "</td>";
                   echo "<td>" . htmlspecialchars($ligneResultat["Nom du Musee"]) . "</td>";
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