<?php
session_start();
//var_dump($_SESSION); 
	if(!$_SESSION['email'])
	{
		header('Location: ../index.php' ); //redirect to start over
		die(); //destroy the session
	}

include("dBConnect.php");

    $sql = "DELETE FROM Address WHERE ADDRESS_ID='" . $_SESSION['addressId'] . "' ";
    $result = $conn->query($sql);
    if (session_destroy()) // Destroying All Sessions
    {
        header("Location: ../index.php"); // Redirecting To Home Page
    }


// Close the database connection
mysqli_close($conn);


?>