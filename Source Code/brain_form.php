<? php include("connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style_brain.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Brain Tumor Form</title>
</head>
<body>
    <div class="container">
        <header>Brain Tumor</header>

        <form action="#" method="POST" enctype="multipart/form-data">
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
                                <option value="Headaches">Headaches</option>
                                <option value="Seizures">Seizures</option>
                                <option value="Nausea And Vomiting">Nausea and Vomiting</option>
                                <option value="Vision Changes">Vision Changes</option>
                                <option value="Balance AndCoordination Problems">Balance and Coordination Problems</option>
                                <option value="Cognitive Changes">Cognitive Changes</option>
                                <option value="Personality Or MoodChanges">Personality or Mood Changes</option>
                                <option value="Speech Or Language Difficulties">Speech or Language Difficulties</option>
                                <option value="Weakness Or Numbness">Weakness or Numbness</option>
                                <option value="Fatigue">Fatigue</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label><b>Treatment History</b></label>
                            <select name="ftreatment" required>
                                <option value="" disabled selected>Select Treatment</option>
                                <option value="No Treatment">No Treatment</option>
                                <option value="Surgery">Surgery</option>
                                <option value="Chemotherapy">Chemotherapy</option>
                                <option value="Radiation Therapy">Radiation Therapy</option>
                                <option value="Immunotherapy">Immunotherapy</option>
                                <option value="Targeted Therapy">Targeted Therapy</option>
                                <option value="Clinical Trial">Clinical Trial</option>
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
                            <textarea placeholder="Enter your medical history/previous medical conditions/family history/Chronic Pain or Disability" rows="4" name="fhistory" required></textarea>
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
    $fphoto = uploadFile('fphoto', 'brain_pat_img/');
    $fid    = uploadFile('fid', 'brain_patID_img/');
    $fimg   = uploadFile('fdimg', 'brain_patDes_img/');
    $freport = uploadFile('freport', 'reportofBrain/');


    if ($fphoto && $fid && $fimg && $freport) {
        // Assuming you have a database connection ($conn) established

        // Fix the table name and backtick for 'fimg'
        $query = "INSERT INTO `brainform` (Fullname, DoB, Email, Mobile, Gender, Occupation, Photo, YourID, YourImage, Country, State, PinCode, Report, Symptoms, Treatment_History, Medical_History) VALUES ('$fname','$fdob','$femail','$fmob','$fgend','$focc','$fphoto','$fid','$fimg','$fcont','$fstate','$fcode','$freport','$fsymptoms','$ftreatment','$fhistory')";
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

