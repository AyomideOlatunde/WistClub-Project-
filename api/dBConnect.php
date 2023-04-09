<?php
	$myHost = "localhost"; // host name
	$myUserName = "CS425_Spr23";   // database login user name
	$myPassword = "Cs425_Spr23";  // database login password
	$myDataBaseName = "CS425_Spr23"; // database name


	/* Attempt MySQL server connection with default setting (user 'root' with no password) */
	$conn = mysqli_connect($myHost, $myUserName, $myPassword, $myDataBaseName);
 
	// Check connection
	if($conn === false)
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
   ?>