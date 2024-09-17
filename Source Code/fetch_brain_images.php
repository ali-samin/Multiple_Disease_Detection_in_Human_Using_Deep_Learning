<?php
include("connection.php");

// Query to fetch the last disease image along with its ID
$query = "SELECT id, YourImage FROM brainform ORDER BY id DESC LIMIT 1";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Fetch the last row
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $imagePath = $row['YourImage'];
    
    // Call the disease detection script to predict the disease for the last image
    $predictedDiseaseOutput = shell_exec("python brain_tumor_detection.py $imagePath");

    // Use regular expression to extract only the disease name from the output
    if (preg_match('/(\w+)$/', $predictedDiseaseOutput, $matches)) {
        $predictedDisease = $matches[1];

        // Save the predicted disease in the database
        $updateQuery = "UPDATE brainform SET Result = '$predictedDisease' WHERE id = $id";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            echo "Predicted disease saved successfully.<br><br>";
        } else {
            echo "Failed to save predicted disease.<br><br>";
        }

        // Output the ID and predicted disease
        echo "id: $id <br>";
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
