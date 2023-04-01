<?php
include("dBConnect.php");
include("config.php");
session_start();
// Retrieve the user's login credentials from form input
$EMAIL = $_POST['myEmail'];
$PASSWORD = $_POST['myPassword'];

if($_POST['Admin']=='Y'){
        $USER_ROLE='Admin';
    }else{
        $USER_ROLE='Member';
    }
    //Get members information
    $sql = "SELECT * FROM Members WHERE EMAIL='$EMAIL' AND USER_ROLE='$USER_ROLE'";
    $result = $conn->query($sql);
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
            
            //Get Address Details
            $sql3 = "SELECT * FROM Address_Details WHERE ZIPCODE='".$add_row['ZIPCODE']."'";
            $result3 = $conn->query($sql3);
            $addDetails_row = mysqli_fetch_assoc($result3);

            // Password is correct, set session variable
            $_SESSION['email'] = $mem_row['EMAIL'];
            $_SESSION['fname'] = $mem_row['F_NAME'];
            $_SESSION['lname'] = $mem_row['L_NAME'];
            $_SESSION['userRole'] = $mem_row['USER_ROLE'];
            $_SESSION['addressId'] = $mem_row['ADDRESS_ID'];
            $_SESSION['password'] = $mem_row['PASSWORD'];
            $_SESSION['street'] = $add_row['STREET'];
            $_SESSION['city'] = $add_row['CITY'];
            $_SESSION['zipcode'] = $add_row['ZIPCODE'];
            $_SESSION['state'] = $addDetails_row['STATE'];
            
            // Redirect the user to the home page
            header("Location: index.php");
        }
        else{
            //write error messages (incorrect password)???

            //Redirect back to login
            header("Refresh:0; url=login.html");
        }
    }else{
        //write error messages (account doesnt exist)???

        //Redirect back to login
		header("Refresh:0; url=login.html");
    }
?>