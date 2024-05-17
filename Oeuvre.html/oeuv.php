<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Encodage des caractères en UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configuration de la mise en page pour les appareils mobiles -->
    <title>Notre site internet</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> <!-- Lien vers les icônes Font Awesome -->
    <link rel="stylesheet" type="text/css" href="oeuv.css"> <!-- Lien vers le fichier CSS externe -->
</head> 

<body>
    <!-- Menu toggle avec checkbox pour afficher/masquer le menu -->
    <label>
      <input type="checkbox">
      <div class="toggle">
        <span class="top_line common"></span>
        <span class="middle_line common"></span>
        <span class="bottom_line common"></span>
      </div>

      <!-- Menu slide -->
      <div class="slide">
        <h1>MENU</h1>
        <ul>
          <li><a href="#"><i class="fas fa-user"></i> Profile </a></li>
          <li><a href="#"><i class="far fa-address-book"></i> Télécommande </a></li>
          <li><a href="#"><i class="fas fa-tv"></i> Oeuvre d'art </a></li>
          <li><a href="#"><i class="fas fa-comments"></i> Events </a></li>
        </ul>
      </div>
    </label>

        <div class="header">
            <img src="Logo.png" alt="Logo" width="50" height="50">
            <h1>GalleryGuardian</h1>
         
        </div >
        <div class="content">
  <<div class="main-content">
        <div class="table-container">
            <h4>Localisation des oeuvres</h4>
            <table class="center-table" border="1">
      <
        <thead>
          <tr>
            <th>Num oeuvre</th>
            <th>Emplacement</th>
            <th>Nom du musée</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include 'bd.php';  // Vérifiez que ce fichier configure correctement la connexion PDO"
          try {
            $requete = "SELECT O.idOeuvre as `Num oeuvre`, O.Emplacement as Emplacement, M.Nom as `Nom du Musee`
            FROM Oeuvreart O, Musee M
            WHERE O.idMusee = M.idMusee";/* Cette requête permet d'obtenir le numéro de l'œuvre, le nom du musée où elle se trouve, ainsi que son emplacement. */

            $resultat = $bdd->query($requete);

            if ($resultat->rowCount() == 0) {//la verification de resultat si il retourne rien 
              echo "<tr><td colspan='2'>Aucune ligne ne correspond</td></tr>";// Si rowCount()=0  affichage d'un message 
            } else {
              while ($ligneResultat = $resultat->fetch(PDO::FETCH_ASSOC)) {// si la boucle retourne un ou plusieurs données 
                echo "<tr>"; //on cree une ligne
                echo "<td>" . htmlspecialchars($ligneResultat["Num oeuvre"]) . "</td>";//insertion de resultat  retourne (Num oeuvre) dans la case de colonne Num oeuvre 
                echo "<td>" . htmlspecialchars($ligneResultat["Emplacement"]) . "</td>";//insertion de resultat  retourne (Emplacement) dans la case de colonne Emplacement
                 echo "<td>" . htmlspecialchars($ligneResultat["Nom du Musee"]) . "</td>";////insertion de resultat  retourne (Nom du Musee) dans la case de colonne Nom Musee
                }
              }
          } catch (PDOException $e) {// si il y'a une execption 
              echo "<tr><td colspan='3'>Erreur dans l'exécution de la requête : " . $e->getMessage() . "</td></tr>";// on utilise colspan pour afficher le  message d'erreur ou le  message indiquant qu'aucune ligne ne correspond et de  s'étendre sur toutes les colonnes du tableau
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
        </div>
  <footer class =footer>
    <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
  </footer>
</body>
</html>