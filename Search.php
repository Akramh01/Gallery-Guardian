<?php
header('Content-Type: application/json');
include 'bd.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$data = array();

if ($id > 0) {
    $sql = "SELECT a.idOeuvre, a.NomO, e.Temperature, e.SignalM, e.SignalV
            FROM oeuvreart a
            LEFT JOIN capteur e ON a.idOeuvre = e.idOeuvre
            WHERE a.idOeuvre = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$data) {
        $data = ["error" => "No data found for the given ID"];
    }
} else {
    $data = ["error" => "Invalid ID"];
}

echo json_encode($data);
?>
