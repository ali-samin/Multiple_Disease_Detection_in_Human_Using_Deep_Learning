<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verified Patients</title>
    <style>
        body {
            background: whitesmoke;
        }

        table {
            background-color: white;
        }
    </style>
</head>
<body>

<h2 align="center">Verified Alzheimer's Patients</h2>
<center>
    <table border="1">
        <tr>
            <!-- Table headers for the columns -->
            <th>ID</th>
            <th>Full Name</th>
            <th>Patient Photo</th>
            <th>Patient ID</th>
            <th>Disease Image</th>
            <th>Patient Reports</th>
            <th>Symptoms</th>
            <th>Treatment History</th>
            <th>Medical History</th>
            <th>Result</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>

        <?php
        // PHP code for fetching and displaying data from the database
        include("connection.php");
        $query = "SELECT * FROM form WHERE verify = 'YES'";
        $data = mysqli_query($conn, $query);

        while ($result = mysqli_fetch_assoc($data)) {
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

            // Display the details of verified patients
            echo "<tr>
                    <td>" . $result['ID'] . "</td>
                    <td>" . $result['Fullname'] . "</td>
                    <td><a href='" . $result['Photo'] . "' target='_blank'><img src='" . $result['Photo'] . "' height='100px' width='100px'></a></td>
                    <td><a href='" . $result['YourID'] . "' target='_blank'><img src='" . $result['YourID'] . "' height='100px' width='150px'></a></td>
                    <td><a href='" . $result['YourImage'] . "' target='_blank'><img src='" . $result['YourImage'] . "' height='100px' width='100px'></a></td>
                    <td>$reportDisplay</td>
                    <td>" . $result['Symptoms'] . "</td>
                    <td>" . $result['Treatment_History'] . "</td>
                    <td>" . $result['Medical_History'] . "</td>
                    <td>" . $result['Result'] . "</td>
                    <td>" . $result['Email'] . "</td>
                    <td>" . $result['Mobile'] . "</td>
                </tr>";
        }
        ?>
    </table>
</center>

</body>
</html>
