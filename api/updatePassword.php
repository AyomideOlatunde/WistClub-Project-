<?php 
session_start();

include("dBConnect.php");
include("../config/config.php");
    
    $EMAIL=$_POST['email'];
    $PASSWORD=$_POST['new_password'];
    $CPASSWORD=$_POST['confirm_password'];

    //error handling
    if ($PASSWORD != $CPASSWORD ) {
    	$err = "Passwords must match!";
    	header("Location: ../forgotPassword.php?email=$EMAIL&error=$err");
	exit;
    }

    $encrypted_password = openssl_encrypt($PASSWORD, ENCRYPTION_METHOD, SECRET_KEY);
    $sql = "UPDATE Members SET PASSWORD='$encrypted_password' WHERE EMAIL = '$EMAIL'";
    $result = $conn->query($sql);
    
    //success message
    header("Location: ../forgotPassword.php?success=Your Password has been updated successfully!");
    exit;

?>