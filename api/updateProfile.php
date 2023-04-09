<?php
    session_start();

    //deactivate session if for some reason there is no session variable
    if(!$_SESSION['email']){
        header('Location : ../index.php'); //redirect to home page
        die(); //destroy session
    }
    include("dBConnect.php");
    include("../config/config.php");
    $EMAIL=$_POST['email'];
    $F_NAME=$_POST['f_Name'];
    $L_NAME=$_POST['l_Name'];
    $PHONE=$_POST['Phone'];
    $CITY=$_POST['City'];
    $STREET=$_POST['Street'];
    $ZIPCODE=$_POST['Zipcode'];
    $STATE=$_POST['State'];
    $PASSWORD=$_POST['Password'];
    $CPASSWORD=$_POST['CPassword'];
    $SECURITY_PIN=$_POST['security_pin'];
    $new_pp=$_POST['profilePic'];
    $old_pp = $_POST['old_pp'];
    $new_img_name=$old_pp;
    
    //error handling
    if ($PASSWORD != $CPASSWORD ) {
    	$err = "Passwords must match!";
    	header("Location: ../profile.php?error=$err");
	    exit;
    }
	
    if($_FILES['profilePic']['name']!=""){
	
    //Handle Filing
    $img_name = $_FILES['profilePic']['name'];
    $tmp_name = $_FILES['profilePic']['tmp_name'];
    $error = $_FILES['profilePic']['error'];

    	if($error === 0){
        	$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        	$img_ex_to_lc = strtolower($img_ex);
        	$allowed_exs = array('jpg', 'jpeg', 'png');
        	if(in_array($img_ex_to_lc, $allowed_exs)){
           		$new_img_name = uniqid($EMAIL, true).'.'.$img_ex_to_lc;
            		$img_upload_path = 'ProfileImages/'.$new_img_name;

            		// Delete old profile pic
            		$old_pp_des = "ProfileImages/$old_pp";
            		if(unlink($old_pp_des)){
               		// just deleted
                
                		if (move_uploaded_file($tmp_name, $img_upload_path)) {
                   	 	echo "File uploaded successfully.";
                		}else {
                    		$err = "Error uploading file: " . $_FILES['profilePic']['error'];
                    		header("Location: ../profile.php?error=$err");
                    		exit;
                		}
          		}else {
                     		$err = "Error uploading file: " . $_FILES['profilePic']['error'];
                    		header("Location: ../profile.php?error=$err");
                    		exit;
                		
          		} 
        	}else{
            	$err = "You can't upload files of this type";
            	header("Location: ../profile.php?error=$err");
            	exit;
        	}
   	}else{
        	$err = "unknown error occurred!";
        	header("Location: ../profile.php?error=$err");
        	exit;
    	}
   }
    // Encrypt the data using the method and key
    $encrypted_password = openssl_encrypt($PASSWORD, ENCRYPTION_METHOD, SECRET_KEY);
    // Attempt to register the account
		$sql = "UPDATE Address SET STREET='".$STREET."', CITY='".$CITY."',STATE='".$STATE."', ZIPCODE='".$ZIPCODE."' WHERE ADDRESS_ID = '".$_SESSION['addressId']."'";
		$result = $conn->query($sql);
		
    // Attempt to register the member
		$sql = "UPDATE Members SET F_NAME='".$F_NAME."', L_Name='".$L_NAME."', PHONE_NO='".$PHONE."', PASSWORD='".$encrypted_password."', PROFILE_IMAGE='".$new_img_name."',SECURITY_PIN='".$SECURITY_PIN."' WHERE ADDRESS_ID = '".$_SESSION['addressId']."'";
		$result = $conn->query($sql);
    // Update session variables
     	    $decrypted_password = openssl_decrypt($encrypted_password, ENCRYPTION_METHOD, SECRET_KEY);
            $_SESSION['fname'] = $F_NAME;
            $_SESSION['lname'] = $L_NAME;
	          $_SESSION['phoneno']= $PHONE;
            $_SESSION['password'] = $decrypted_password;
            $_SESSION['street'] = $STREET;
            $_SESSION['city'] = $CITY;
            $_SESSION['zipcode'] = $ZIPCODE;
            $_SESSION['state'] = $STATE;
            $_SESSION['profileImage']=$new_img_name;
            $_SESSION['security_pin']=$SECURITY_PIN;
    //success message
    header("Location: ../profile.php?success=Your account has been updated successfully!");
    exit;
    
    
?>
