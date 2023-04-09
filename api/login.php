<?php
include("dBConnect.php");
include("../config/config.php");
session_start();
// Retrieve the user's login credentials from form input
$EMAIL = $_POST['myEmail'];
$PASSWORD = $_POST['myPassword'];

    if($_POST['myAdmin']=='Y'){
        $USER_ROLE='Admin';
    }else{
        $USER_ROLE='Member';
    }
    //Get members information
    $sql = "SELECT * FROM Members WHERE EMAIL=? AND USER_ROLE=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $EMAIL, $USER_ROLE);
	$stmt->execute();
	$result = $stmt->get_result();      
	if (mysqli_error($conn)) {
                die('Error: ' . mysqli_error($conn));
      }
	//--Results returned at least on entry from the database query--
     if (mysqli_num_rows($result) > 0) {
        // Retrieve the hashed password from the database record
        $mem_row = mysqli_fetch_assoc($result);
        $pwd = $mem_row['PASSWORD'];

        // hash current password
        $decrypted_password = openssl_decrypt($pwd, ENCRYPTION_METHOD, SECRET_KEY);

        // Verify the user's password using password_verify()
       if ($decrypted_password==$PASSWORD) {
            // Get Address Information
            $sql2 = "SELECT * FROM Address WHERE ADDRESS_ID='".$mem_row['ADDRESS_ID']."'";
            $result2 = $conn->query($sql2);
            $add_row = mysqli_fetch_assoc($result2);
            
            // Password is correct, set session variable
            $_SESSION['email'] = $mem_row['EMAIL'];
            $_SESSION['fname'] = $mem_row['F_NAME'];
            $_SESSION['lname'] = $mem_row['L_NAME'];
	        $_SESSION['profileImage'] = $mem_row['PROFILE_IMAGE'];
            $_SESSION['userRole'] = $mem_row['USER_ROLE'];
            $_SESSION['addressId'] = $mem_row['ADDRESS_ID'];
            $_SESSION['phoneno']= $mem_row['PHONE_NO'];
            $_SESSION['security_pin'] = $mem_row['SECURITY_PIN'];
            $_SESSION['password'] = $decrypted_password;
            $_SESSION['street'] = $add_row['STREET'];
            $_SESSION['city'] = $add_row['CITY'];
            $_SESSION['zipcode'] = $add_row['ZIPCODE'];
            $_SESSION['state'] = $add_row['STATE'];
	    
		
            if($USER_ROLE=='Admin'){
             header("Refresh:0; url=../Admin/home.php");
            }else if($USER_ROLE=='Member'){
            	header("Refresh:0; url=../index.php");
            }
        }
        else{
            //write error messages (incorrect password)???

            //Redirect back to login
            $err = "Incorrect Password!";
    	    header("Location: ../loginM.php?error=$err");
	    exit;
        }
    }else{
        //write error messages (account doesnt exist)???

        $err = "Invalid Email, Please Create an Account!";
    	header("Location: ../loginM.php?error=$err");
	exit;    
    }
?>