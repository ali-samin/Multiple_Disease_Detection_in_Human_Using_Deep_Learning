<?php
include("connection.php");

// Query to fetch the last disease image along with its ID
$query = "SELECT ID, YourImage FROM form ORDER BY ID DESC LIMIT 1";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Fetch the last row
    $row = mysqli_fetch_assoc($result);
    $id = $row['ID'];
    $imagePath = $row['YourImage'];
    
    // Call the disease detection script to predict the disease for the last image
    $predictedDiseaseOutput = shell_exec("python disease_detection.py $imagePath");

    // Use regular expression to extract only the disease name from the output
    if (preg_match('/(\w+)$/', $predictedDiseaseOutput, $matches)) {
        $predictedDisease = $matches[1];

        // Save the predicted disease in the database
        $updateQuery = "UPDATE form SET Result = '$predictedDisease' WHERE ID = $id";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            echo "Predicted disease saved successfully.<br><br>";
        } else {
            echo "Failed to save predicted disease.<br><br>";
        }

        // Output the ID and predicted disease
        echo "ID: $id <br>";
        echo "Predicted Disease: $predictedDisease <br><br>";
    } else {
        echo "Failed to extract predicted disease from output.<br><br>";
    }
} else {
    echo "No images found in the database.";
}

// Close the connection
mysqli_close($conn);
?>

<!-- Meta tag for refreshing the page every 5 seconds -->
<meta http-equiv="refresh" content="5">
