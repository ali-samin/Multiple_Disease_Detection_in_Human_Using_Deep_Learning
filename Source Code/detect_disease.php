<?php
include("connection.php");

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Your existing code to process form data...
    
    // File handling for disease image
    $fdimg = uploadFile('fdimg', 'diseaseimg/');

    if ($fdimg) {
        // Call the Python script to predict the disease class
        $imagePath = $fdimg;
        $predictedDisease = shell_exec("python3 disease_detection.py $imagePath");

        // Output the predicted disease class
        echo "Predicted Disease Class: $predictedDisease";
    } else {
        // Handle file upload errors
        echo "File upload failed. ";
    }
}

// Function to handle file uploads
// Your existing uploadFile function...
?>
