<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gualleryguardian";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the type parameter from the query string
$type = isset($_GET['type']) ? $_GET['type'] : '';

$data = array();

if ($type == 'capteur') {
    // Fetch environmental data
    $sql = "SELECT Temperature, SignalM, SignalV FROM capteur ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
} elseif ($type == 'door') {
    // Fetch door status
    $sql = "SELECT SignalDP FROM detecteurporte";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
}

$conn->close();

// Return the data as JSON
echo json_encode($data);
?>

