<?php
    include("dBConnect.php");
    include("../config/config.php");
    
    $F_NAME=$_POST['f_Name'];
    $L_NAME=$_POST['l_Name'];
    $EMAIL=$_POST['Email'];
    $PHONE=$_POST['Phone'];
    $CITY=$_POST['City'];
    $STREET=$_POST['Street'];
    $ZIPCODE=$_POST['Zipcode'];
    $STATE=$_POST['State'];
    $PASSWORD=$_POST['Password'];
    $CPASSWORD=$_POST['CPassword'];
    $SECURITY_PIN=$_POST['security_pin'];
    if($_POST['Admin']=='Y'){
        $USER_ROLE='Admin';
    }else{
        $USER_ROLE='Member';
    }
    //error handling
    if ($PASSWORD != $CPASSWORD ) {
    	$err = "Passwords must match!";
    	header("Location: ../registerM.php?error=$err");
	    exit;
    }else if($_FILES["profilePic"]["error"] == UPLOAD_ERR_NO_FILE){
        $err="Missing Profile Picture!";
        header("Location: ../registerM.php?error=$err");
	    exit;
    }
    // Check if the email is already registered
    $sql = "SELECT * FROM Members WHERE EMAIL = '$EMAIL' ";
    $result1 = $conn->query($sql);

    if($result1 -> num_rows > 0){ //if email is already registered
	$err = "Email already exists!";
        header("Location: ../registerM.php?error=$err");
        exit;

          //header("Refresh:0; url=../registerM.php");
    }
	//Handle Filing
    $target_dir = "ProfileImages/";
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
           
	    if (move_uploaded_file($tmp_name, $img_upload_path)) {
    		echo "File uploaded successfully.";
	    } else {
   		$err = "Error uploading file: " . $_FILES['profilePic']['error'];
        	header("Location: ../registerM.php?error=$err");
        	exit;
	    }
        }else{
            $err = "You can't upload files of this type";
            header("Location: ../registerM.php?error=$err");
            exit;
        }
    }
    else{
        $err = "unknown error occurred!";
        header("Location: ../registerM.php?error=$err");
        exit;
    }
     // Encrypt the data using the method and key
    $encrypted_password = openssl_encrypt($PASSWORD, ENCRYPTION_METHOD, SECRET_KEY);

    
    if($result1 -> num_rows > 0){ //if email is already registered
	
          //header("Refresh:0; url=../registerM.php");
    }else{
	$EMAIL=strtolower($EMAIL);
       	// Insert the new address record
        $sql_address = "INSERT INTO Address (STREET, CITY,STATE, ZIPCODE) VALUES ('$STREET', '$CITY','$STATE','$ZIPCODE')";
        mysqli_query($conn, $sql_address);

        // Get the last inserted address_id value
	    $address_id = mysqli_insert_id($conn);
	
        // Insert the new member record with the corresponding address_id value
        $sql_member = "INSERT INTO Members (EMAIL,F_NAME, L_NAME, PHONE_NO, PASSWORD,ADDRESS_ID,PROFILE_IMAGE,USER_ROLE,SECURITY_PIN) VALUES ('$EMAIL', '$F_NAME', '$L_NAME', '$PHONE','$encrypted_password', $address_id, '$new_img_name', '$USER_ROLE',$SECURITY_PIN)";
        mysqli_query($conn, $sql_member);
	if (mysqli_error($conn)) {
                die('Error: ' . mysqli_error($conn));
      }

	//redirect to index page
        header("Refresh:0; url=../index.php");
        
    }    
    // Close the database connection
    mysqli_close($conn);
?>