<?php
session_start();
include("../api/dBConnect.php");

$ADDRESS_ID = $_GET['ADDRESS_ID'];

    $sql = "DELETE FROM Address WHERE ADDRESS_ID='$ADDRESS_ID' ";
    $result = $conn->query($sql);
    if (mysqli_error($conn)) {
                die('Error: ' . mysqli_error($conn));
      }
    
// Close the database connection
mysqli_close($conn);
?>