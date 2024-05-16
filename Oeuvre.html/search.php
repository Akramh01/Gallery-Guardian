
<?php
include 'bd.php';  // Assurez-vous que ce fichier configure la connexion PDO

if (isset($_GET['search'])) {
    $search_query = htmlspecialchars($_GET['search']);

    // Exemple de traitement de la recherche
    echo "<h1>Résultats de recherche pour l'œuvre numéro : " . $search_query . "</h1>";

    // Requête SQL pour rechercher par numéro de l'œuvre
    try {
        $requete = $bdd->prepare("SELECT O.idOeuvre as `Num oeuvre` ");
           
        $requete->execute(['search_query' => $search_query]);

        if ($requete->rowCount() == 0) {
            echo "<p>Aucun résultat trouvé pour l'œuvre numéro " . $search_query . "</p>";
        } else {
            
            while ($ligneResultat = $requete->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($ligneResultat["Num oeuvre"]) . "</td>";
                echo "<td>" . htmlspecialchars($ligneResultat["Emplacement"]) . "</td>";
                echo "<td>" . htmlspecialchars($ligneResultat["Nom du Musee"]) . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        }
    } catch (PDOException $e) {
        echo "<p>Erreur dans l'exécution de la requête : " . $e->getMessage() . "</p>";
    }
} else {
    echo "<h1>Aucune recherche effectuée</h1>";
}
?>
