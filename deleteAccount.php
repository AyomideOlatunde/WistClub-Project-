<?php
session_start();
//var_dump($_SESSION); 
	if(!$_SESSION['email'])
	{
		header('Location: index.php' ); //redirect to start over
		die(); //destroy the session
	}

include("dBConnect.php");
$info = "SELECT COUNT(*) as count FROM Address WHERE ZIPCODE='" . $_SESSION['zipcode'] . "'";
$infoResult = $conn->query($info);

//fetch count value
$row = mysqli_fetch_assoc($infoResult);
$count = $row['count'];

if ($count == "1") {
    $sql = "DELETE FROM Address_Details WHERE ZIPCODE='" . $_SESSION['zipcode'] . "' ";
    $result = $conn->query($sql);
    if (session_destroy()) // Destroying All Sessions
    {
        header("Location: index.php"); // Redirecting To Home Page
    }
} else {
    $sql = "DELETE FROM Address WHERE ADDRESS_ID='" . $_SESSION['addressId'] . "' ";
    $result = $conn->query($sql);
    if (session_destroy()) // Destroying All Sessions
    {
        header("Location: index.php"); // Redirecting To Home Page
    }

}

// Close the database connection
mysqli_close($conn);


?>