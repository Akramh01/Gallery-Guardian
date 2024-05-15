<?php
$servername = "localhost"; // Nom du serveur MySQL
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL
$dbname = "15maigallery"; // Nom de la base de données

// Création d'une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>

<?php
// Requête SQL pour sélectionner des données depuis une table
$sql = "SELECT NomO FROM Oeuvreart";
$result = $conn->query($sql);

// Vérification s'il y a des résultats
if ($result->num_rows > 0) {
    // Boucle à travers chaque ligne de résultat
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Nom: " . $row["nom"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "Aucun résultat trouvé";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>

