<?php
header('Content-Type: application/json');
include 'bd.php';

$type = isset($_GET['type']) ? $_GET['type'] : '';

$data = array();

if ($type == 'capteur') {
    $sql = "SELECT Temperature, SignalM, SignalV FROM capteur";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$data) {
        $data = ["error" => "No data found"];
    }
} else {
    $data = ["error" => "Invalid type"];
}

echo json_encode($data);
?>
