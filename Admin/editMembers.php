<?php
    session_start();

    //deactivate session if for some reason there is no session variable
    if(!$_SESSION['email'] || $_SESSION['userRole']!='Admin'){
        header('Location: ../index.php'); //redirect to home page
        die(); //destroy session
    }

    include("../api/dBConnect.php");
    include("../config/config.php");
    $EMAIL=$_POST['email'];
    $ADDRESS_ID=$_POST['ADDRESS_ID'];
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
    	header("Location: edit.php?error=$err");
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
                    		header("Location: edit.php?error=$err");
                    		exit;
                		}
          		}else {
                     		$err = "Error uploading file: " . $_FILES['profilePic']['error'];
                    		header("Location: edit.php?error=$err");
                    		exit;
                		
          		} 
        	}else{
            	$err = "You can't upload files of this type";
            	header("Location: edit.php?error=$err");
            	exit;
        	}
   	}else{
        	$err = "unknown error occurred!";
        	header("Location: edit.php?error=$err");
        	exit;
    	}
   }
    // Encrypt the data using the method and key
    $encrypted_password = openssl_encrypt($PASSWORD, ENCRYPTION_METHOD, SECRET_KEY);
    // Attempt to register the account
		$sql = "UPDATE Address SET STREET='".$STREET."', CITY='".$CITY."',STATE='".$STATE."', ZIPCODE='".$ZIPCODE."' WHERE ADDRESS_ID = '$ADDRESS_ID'";
		$result = $conn->query($sql);
		
    // Attempt to register the member
		$sql = "UPDATE Members SET F_NAME='".$F_NAME."', L_Name='".$L_NAME."', PHONE_NO='".$PHONE."', PASSWORD='".$encrypted_password."', PROFILE_IMAGE='".$new_img_name."',SECURITY_PIN='".$SECURITY_PIN."' WHERE ADDRESS_ID = '$ADDRESS_ID'";
		$result = $conn->query($sql);
   
    //success message
    header("Location: edit.php?success=Your account has been updated successfully!");
    exit;
    
    // Close the database connection
    mysqli_close($conn);
?>
