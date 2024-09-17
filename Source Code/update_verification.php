<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $patientId = $_POST['patientId'];

    // Update the 'verify' column in the database based on the action
    $updateQuery = "UPDATE form SET verify = '$action' WHERE ID = '$patientId'";
    mysqli_query($conn, $updateQuery);

    // Send a response (you can customize this based on your needs)
    echo "Database updated successfully";
}
?>