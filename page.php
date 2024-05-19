<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Encodage des caractères en UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configuration de la mise en page pour les appareils mobiles -->
    <title>Notre site internet</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> <!-- Lien vers les icônes Font Awesome -->
    <link rel="stylesheet" type="text/css" href="page.css"> <!-- Lien vers le fichier CSS externe -->
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

    <!-- Header avec logo et titre -->
    <div class="header">
        <img src="Logo.png" alt="Logo" width="50" height="50"> <!-- Logo du site -->
        <h1>GalleryGuardian</h1> <!-- Titre du site -->
    </div>

    <!-- Section principale -->
    <div class="section2">
        <!-- Section pour l'image et le titre -->
        <div class="content-section">
            <h3 class="front-title">Oeuvre</h3>
            <img src="img.jpg" alt="Oeuvre d'art"> <!-- Image de l'œuvre d'art -->
        </div>

        <!-- Conteneur des tableaux -->
        <div class="table-container">
            <!-- Container pour le tableau 'Remote' -->
            <div class="remote-table">
                <h2>Data Oeuvre</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Température</th>
                            <th>Humidité</th>
                            <th>Luminosité</th>
                            <th>Nom de l'art</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Les données PHP seront générées ici -->
                    <?php
    
                         include 'bd.php';
                         
                         // Fetch environmental data
                         $result = $conn->query("SELECT Temperature, SignalM, SignalV, NomO FROM capteur ORDER BY id DESC LIMIT 1");
                         if ($result->num_rows > 0) {
                             $data = $result->fetch_assoc();
                             echo "<td>" . ($data['Temperature'] ?? 'N/A') . "</td>";
                             echo "<td>" . ($data['SignalM'] ?? 'N/A') . "</td>";
                             echo "<td>" . ($data['SignalV'] ?? 'N/A') . "</td>";
                             echo "<td>" . ($data['NomO'] ?? 'N/A') . "</td>";
                         } else {
                             echo "<td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td>";
                         }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Container pour le tableau 'Alerte' -->
            <div class="alert-table">
                <h2>Alert !</h2>
                <table>
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
        $sql = "SELECT * FROM Evenement ORDER BY idEvent DESC LIMIT 1";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
     catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    } catch(Exception $e) {
        echo "<tr><td colspan='5'>Erreur : " . htmlspecialchars($e->getMessage()) . "</td></tr>";
    } finally {
        $bdd = null; //Fermeture de la connexion
    }

        ?>
        </tbody>
    </table>
    </div>  

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
</body>
</html>