<!DOCTYPE html>
<html>
<head>
    <title>Display</title>
    <style>
        body {
            background: whitesmoke;
        }

        table {
            background-color: white;
        }

        #verified-button {
            margin: 5px 0; /* Added margin to the top */
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<button id="verified-button" onclick="redirectToVerifiedPatients()">Verified Patients</button>

<?php
include("connection.php");
error_reporting(0);

$query = "select * from form";
$data = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);

if ($total != 0) {
    ?>
    <h2 align="center">Alzheimer's Patient Details</h2>
    <center>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Mobine No.</th>
                <th>Gender</th>
                <th>Occupation</th>
                <th>Patient Photo</th>
                <th>Patient ID</th>
                <th>Disease Image</th>
                <th>Report</th>
                <th>Symptoms</th>
                <th>Treatment_History</th>
                <th>Medical_History</th>
                <th>Country</th>
                <th>State</th>
                <th>Pin Code</th>
                <th>Verify</th>
            </tr>

<?php
while ($result = mysqli_fetch_assoc($data)) {
    $isCheckedYes = ($result['verify'] === 'YES') ? 'checked' : '';
    $isCheckedNo = ($result['verify'] === 'NO') ? 'checked' : '';

    $reportFile = $result['Report'];
    $fileExtension = pathinfo($reportFile, PATHINFO_EXTENSION);
    $reportDisplay = '';

    if (strtolower($fileExtension) === 'pdf') {
        // If it's a PDF, provide a link to view/download
        $reportDisplay = "<a href='$reportFile' target='_blank'>View PDF</a>";
    } else {
        // If it's an image or another file type, display it using <img>
        $reportDisplay = "<a href='$reportFile' target='_blank'><img src='$reportFile' height='100px' width='100px'></a>";
    }

    echo "<tr data-id='" . $result['ID'] . "'>
            <td>" . $result['ID'] . "</td>
            <td>" . $result['Fullname'] . "</td>
            <td>" . $result['DoB'] . "</td>
            <td>" . $result['Email'] . "</td>
            <td>" . $result['Mobile'] . "</td>
            <td>" . $result['Gender'] . "</td>
            <td>" . $result['Occupation'] . "</td>
            <td><a href='" . $result['Photo'] . "' target='_blank'><img src='" . $result['Photo'] . "' height='100px' width='100px'></a></td>
            <td><a href='" . $result['YourID'] . "' target='_blank'><img src='" . $result['YourID'] . "' height='100px' width='150px'></a></td>
            <td><a href='" . $result['YourImage'] . "' target='_blank'><img src='" . $result['YourImage'] . "' height='100px' width='100px'></a></td>
            <td>$reportDisplay</td>
            <td>" . $result['Symptoms'] . "</td>
            <td>" . $result['Treatment_History'] . "</td>
            <td>" . $result['Medical_History'] . "</td>
            <td>" . $result['Country'] . "</td>
            <td>" . $result['State'] . "</td>
            <td>" . $result['PinCode'] . "</td>
            <td>
                <label><input type='radio' name='verify_" . $result['ID'] . "' data-action='verify' value='YES' $isCheckedYes> YES</label>
                <label><input type='radio' name='verify_" . $result['ID'] . "' data-action='reject' value='NO' $isCheckedNo> NO</label>
            </td>
        </tr>";
}
?>


        </table>
    </center>
    <?php
} else {
    echo "No Records Found";
}
?>

<script>
    function redirectToVerifiedPatients() {
        // Display an alert
        alert("Redirecting to Verified Patients");

        // Redirect to the verified_patients.php page
        window.location.href = 'verified_patients.php';
    }

    $(document).ready(function () {
        // Load radio button states after page load
        $('input[type=radio]').each(function () {
            var radioButton = $(this);
            var patientId = radioButton.attr('name').split('_')[1];
            var isChecked = getCookie('radio_' + patientId) === radioButton.val();
            radioButton.prop('checked', isChecked);
        });

        // Handle radio button changes
        $('input[type=radio]').change(function () {
            var radioButton = $(this);
            var action = radioButton.val();
            var patientId = radioButton.attr('name').split('_')[1];

            // Save radio button state to cookies
            setCookie('radio_' + patientId, action, 365);

            // Use AJAX to send the request to update the database
            $.ajax({
                type: 'POST',
                url: 'update_verification.php',
                data: {
                    action: action,
                    patientId: patientId
                },
                success: function (response) {
                    // Handle the response if needed
                    console.log(response);
                },
                error: function (error) {
                    // Handle the error if needed
                    console.error(error);
                }
            });
        });

        // Cookie functions
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
    });
</script>
</body>
</html>
