<?php

	$servername = "localhost:3307";
	$username = "root";
	$password = "";
	$dbname = "responsiveform3";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if($conn)
	{
		echo "";
		//echo "Connection ok"; //if you want to check that connection is ok , then uncomment this line and delete upper line
	}
	else
	{
		echo "Connection failed", mysqli_connect_error();
	}
?>