<?php 
	ob_start();
	session_start();

	$timezone = date_default_timezone_set("Europe/Vilnius");
	$con = mysqli_connect("localhost", "root", "root","music-library");
	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
	}

 ?>