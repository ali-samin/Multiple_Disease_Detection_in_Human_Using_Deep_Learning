<? php include("connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style_alz.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Alzheimer's Form</title>

</head>
<body>
    <div class="container">
        <header>Alzheimer's</header>

        <form id="alzForm" action="#" method="POST" enctype="multipart/form-data">
            <div class="form first">
                <div class="details personsal">
                    <span class="title"><b>Personal Details</b></span>

                    <div class="fields">

                        <div class="input-field">
                            <label><b>Full Name</b></label>
                            <input type="text"  placeholder="Enter your name" name="fname" required>
                        </div>

                        <div class="input-field">
                            <label><b>Date of Birth</b></label>
                            <input type="date"  placeholder="Enter birth date" name="fdob" required>
                        </div>

                        <div class="input-field">
                            <label><b>Email</b></label>
                            <input type="text"  placeholder="Enter your email" name="femail" required>
                        </div>

                        <div class="input-field">
                            <label><b>Mobile Number</b></label>
                            <input type="number"  placeholder="Enter mobile number" name="fmob" required>
                        </div>

                        <div class="input-field">
                            <label><b>Gender</b></label>
                            <input type="text"  placeholder="Enter your gender" name="fgend" required>
                        </div>
                        
                        <div class="input-field">
                            <label><b>Occupation</b></label>
                            <input type="text"  placeholder="Enter your occupation" name="focc" required>
                        </div>

                        <div class="input-field">
                            <label><b>Your Photo</b></label>
                            <input type="file"  placeholder="Upload your photo" name="fphoto" required>
                        </div>

                        <div class="input-field">
                            <label><b>Your ID Photo</b></label>
                            <input type="file"  placeholder="Upload your ID photo" name="fid" required>
                        </div>

                        <div class="input-field">
                            <label><b>Disease Image</b></label>
                            <input type="file"  placeholder="Upload your disease photo" name="fdimg" required>
                        </div>

                        <div class="input-field">
                            <label><b>Report and Documents</b></label>
                            <input type="file" placeholder="Your Checkup report" name="freport" required>
                        </div>

                        <div class="input-field">
                            <label><b>Symptoms</b></label>
                            <select name="fsymptoms" required>
                                <option value="" disabled selected>Select symptoms</option>
                                <option value="MemoryLoss">Memory Loss</option>
                                <option value="CognitiveDecline">Cognitive Decline</option>
                                <option value="DifficultyPlanningandOrganizing">Difficulty Planning and Organizing</option>
                                <option value="ConfusionAboutTimeorPlace">Confusion About Time or Place</option>
                                <option value="MisplacingItems">Misplacing Items</option>
                                <option value="MoodandPersonalityChanges">Mood and Personality Changes</option>
                                <option value="DifficultyCommunicating">Difficulty Communicating</option>
                                <option value="TroubleCompletingFamiliarTasks">Trouble Completing Familiar Tasks</option>
                                <option value="PoorJudgment">Poor Judgment</option>
                                <option value="ChangesinVisualPerception">Changes in Visual Perception</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label><b>Treatment History</b></label>
                            <select name="ftreatment" required>
                                <option value="" disabled selected>Select Treatment</option>
                                <option value="NoTreatment">No Treatment</option>
                                <option value="Medication">Surgery</option>
                                <option value="CognitiveStimulation">Chemotherapy</option>
                                <option value="BehavioralTherapy">Radiation Therapy</option>
                                <option value="OccupationalTherapy">Immunotherapy</option>
                                <option value="PhysicalExercise">Targeted Therapy</option>
                                <option value="DietandNutrition">Clinical Trial</option>
                                <option value="ClinicalTrials">Other</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label><b>Country</b></label>
                            <input type="text"  placeholder="Enter your country" name="fcont" required>
                        </div>

                        <div class="input-field">
                            <label><b>State</b></label>
                            <input type="text"  placeholder="Enter your state" name="fstate" required>
                        </div>

                        <div class="input-field">
                            <label><b>Pin Code</b></label>
                            <input type="number"  placeholder="Enter your pincode" name="fcode" required>
                        </div>

                        <div class="input-field">
                            <label><b>Medical History</b></label>
                            <textarea placeholder="Enter your medical history/previous medical conditions/family history/Chronic Pain or Disability" rows="3" name="fhistory" required></textarea>
                        </div>

                    </div>
                    <button type="submit" class="Submit" name="submit">
                        <span class="btnText">Submit</span>
                    </button>

                </div>
            </div>
        </form>
    </div>

    
</body>
</html>

<?php
include("connection.php");

// Check if the form is submitted
if(isset($_POST['submit'])) {
    $fname  = $_POST['fname'];
    $fdob   = $_POST['fdob'];
    $femail = $_POST['femail'];
    $fmob   = $_POST['fmob'];
    $fgend  = $_POST['fgend'];
    $focc   = $_POST['focc'];
    $fcont  = $_POST['fcont'];
    $fstate = $_POST['fstate'];
    $fcode  = $_POST['fcode'];
    $fsymptoms = $_POST['fsymptoms'];
    $ftreatment = $_POST['ftreatment'];
    $fhistory  = $_POST['fhistory'];

    // File handling for photo, ID photo, and disease image
    $fphoto = uploadFile('fphoto', 'patimg/');
    $fid    = uploadFile('fid', 'idimg/');
    $fimg   = uploadFile('fdimg', 'diseaseimg/');
    $freport = uploadFile('freport', 'reportofAlz/');


    if ($fphoto && $fid && $fimg && $freport) {
        // Assuming you have a database connection ($conn) established

        // Fix the table name and backtick for 'fimg'
        $query = "INSERT INTO `form` (Fullname, DoB, Email, Mobile, Gender, Occupation, Photo, YourID, YourImage, Country, State, PinCode, Report, Symptoms, Treatment_History, Medical_History) VALUES ('$fname','$fdob','$femail','$fmob','$fgend','$focc','$fphoto','$fid','$fimg','$fcont','$fstate','$fcode','$freport','$fsymptoms','$ftreatment','$fhistory')";

        $data = mysqli_query($conn, $query);

        if($data) {
            echo "<script> alert('Data Inserted into Database')</script>";
        } else {
            echo "<script> alert('Failed')</script>";
        }
    } else {
        // Handle file upload errors
        echo "File upload failed. ";
    }
}

// Function to handle file uploads
function uploadFile($fileInputName, $targetDirectory) {
    $targetFile = $targetDirectory . basename($_FILES[$fileInputName]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadMessages = '';  // Variable to collect upload messages

    // Check if file already exists
    if (file_exists($targetFile)) {
        $uploadMessages .= "Sorry, file already exists. ";
        $uploadOk = 0;
    }

    // Check file size (you can modify this value according to your needs)
    if ($_FILES[$fileInputName]["size"] > 500000) {
        $uploadMessages .= "Sorry, your file is too large. ";
        $uploadOk = 0;
    }

    // Allow certain file formats (you can modify this list according to your needs)
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf") {
        $uploadMessages .= "Sorry, only JPG, JPEG, PNG , GIF and PDF files are allowed. ";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $uploadMessages .= "File upload failed. ";
    } else {
        // Move the file to the specified directory
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
            $uploadMessages .= "The file " . htmlspecialchars(basename($_FILES[$fileInputName]["name"])) . " has been uploaded successfully. ";
            return $targetFile; // Return the path to the uploaded file
        } else {
            $uploadMessages .= "Sorry, there was an error uploading your file. ";
            $uploadMessages .= "Error: " . $_FILES[$fileInputName]["error"] . " ";
            return false;
        }
    }

    // Log the upload messages (you can save this to a file or database)
    file_put_contents('upload_log.txt', $uploadMessages, FILE_APPEND);

    // Return false to indicate upload failure
    return false;
}
?>

