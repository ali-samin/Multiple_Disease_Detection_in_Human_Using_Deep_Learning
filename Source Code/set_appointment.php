<?php
// Include connection file
include("connection.php");

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data
    $patientId = $_POST['patient_id'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $doctorName = $_POST['doctor_name'];
    $notes = $_POST['notes'];

    // Insert appointment into database
    $query = "INSERT INTO appointments (patient_id, appointment_date, appointment_time, doctor_name, notes) VALUES ('$patientId', '$appointmentDate', '$appointmentTime', '$doctorName', '$notes')";
    $result = mysqli_query($conn, $query);

    if($result) {
        // Appointment successfully added
        echo "<script>alert('Appointment set successfully.')</script>";
    } else {
        // Appointment insertion failed
        echo "<script>alert('Failed to set appointment.')</script>";
    }
}

// Redirect back to verified patients page
header("Location: verified_patients.php");
exit();
?>
