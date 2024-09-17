<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="style_login.css">

	<title>Login Form</title>

</head>

<body>
	<div class="center">
		<h1>Login</h1>

		<form action="#" method="POST" autocomplete="off">

		<div class="form">
			<input type="text" name="username" class="textfield" placeholder="Username">
			<input type="password" name="password" class="textfield" placeholder="password">

			<div class="forgetpass"><a href="#" class="link" onclick="message()">Forget Password?</a></div>

			<input type="submit" name="login" value="login" class="btn">

			<div class="signup">New Member? <a href="#" class="link" onclick="message()">Signup here</a></div>
		</div>
	</div>
	</form>

<script>
	function message()
	{
		alert("Not Decide Yet")
	}
</script>

</body>

</html>


<?php
    include("connection.php");

    if (isset($_POST['login']))
    {
        $username = $_POST['username'];
        $pwd = $_POST['password'];

        $queryAdmin = "SELECT * FROM admin WHERE Username = '$username' AND Password = '$pwd'";
        $dataAdmin = mysqli_query($conn, $queryAdmin);
        $totalAdmin = mysqli_num_rows($dataAdmin);

        if($totalAdmin == 1)
        {
            header('location: display.php');
            exit();
        }
        else
        {
            // If credentials not found in admin table, check brainadmin table
            $queryBrainAdmin = "SELECT * FROM brainadmin WHERE Username = '$username' AND Password = '$pwd'";
            $dataBrainAdmin = mysqli_query($conn, $queryBrainAdmin);
            $totalBrainAdmin = mysqli_num_rows($dataBrainAdmin);

            if ($totalBrainAdmin == 1)
            {
                header('location: display_brain.php');
                exit();
            }
            else
            {
                echo "Login Failed";
            }
        }
    }
?>
