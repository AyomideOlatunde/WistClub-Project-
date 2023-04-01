<?php
    include("dBConnect.php");
    include("config.php");
    $F_NAME=$_POST['f_Name'];
    $L_NAME=$_POST['l_Name'];
    $EMAIL=$_POST['Email'];
    $PHONE=$_POST['Phone'];
    $CITY=$_POST['City'];
    $STREET=$_POST['Street'];
    $ZIPCODE=$_POST['Zipcode'];
    $STATE=$_POST['State'];
    $PASSWORD=$_POST['Password'];

    if($_POST['Admin']=='Y'){
        $USER_ROLE='Admin';
    }else{
        $USER_ROLE='Member';
    }

    // Encrypt the data using the method and key
    $encrypted_password = openssl_encrypt($PASSWORD, ENCRYPTION_METHOD, SECRET_KEY);

    // Check if the email is already registered
    $sql = "SELECT * FROM Members WHERE EMAIL = '$EMAIL' ";
    $result1 = $conn->query($sql);

    if($result1 -> num_rows > 0){ //if email is already registered
        //send error messages here ???????????????????????
	 echo 'alert("Email already exist!")';
        header("Refresh:0; url=register.html");
    }else{
        // Check if the zipcode exists in the database
        $sql = "SELECT * FROM Address_Details WHERE ZIPCODE = '$ZIPCODE' ";
        $result2 = $conn->query($sql);

        if($result2 -> num_rows == 0){
            // Insert the new address record
            $sql_addressDetails = "INSERT INTO Address_Details (ZIPCODE, STATE) VALUES ('$ZIPCODE', '$STATE')";
            mysqli_query($conn, $sql_addressDetails);
        }
	// Insert the new address record
        $sql_address = "INSERT INTO Address (STREET, CITY, ZIPCODE) VALUES ('$STREET', '$CITY', '$ZIPCODE')";
        mysqli_query($conn, $sql_address);

        // Get the last inserted address_id value
	$address_id = mysqli_insert_id($conn);

	$image="image.jpg";
        // Insert the new member record with the corresponding address_id value
        $sql_member = "INSERT INTO Members (EMAIL,F_NAME, L_NAME, PHONE_NO, PASSWORD,ADDRESS_ID,PROFILE_IMAGE,USER_ROLE) VALUES ('$EMAIL', '$F_NAME', '$L_NAME', '$PHONE','$encrypted_password', $address_id, '$image', '$USER_ROLE')";
        mysqli_query($conn, $sql_member);
        if (mysqli_error($conn)) {
    	die('Error: ' . mysqli_error($conn));
	}
        header("Refresh:0; url=index.php");
    }

    // Close the database connection
    mysqli_close($conn);
?>