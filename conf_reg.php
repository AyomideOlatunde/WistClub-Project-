<?php
	include("dBConnect.php");
	
	session_start();
	
	$link = mysqli_connect($myHost, $myUserName, $myPassword, $myDataBaseName);

 
	// Check connection
	if($link === false)
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	

	


	if($_SESSION)
	{
		$type = $_POST['select1'];
		$EMAIL = $_SESSION['email'];
		$ZIPCODE = $_SESSION['zipcode'];
		$STREET = $_SESSION['street'];
		$CITY = $_SESSION['city'];
		$STATE = $_SESSION['state'];
		$FNAME = $_SESSION['fname'];
		$LNAME = $_SESSION['lname'];
		$PHONE = $_SESSION['phone'];
		$PASSWORD =  $_SESSION['password'] ;
		$TYPE = $_SESSION['userRole'];


		//user was already logged in
		if($type=="option1") //if user is registering as an individual 
		{
			
			// Check if user as already registered, to prevent duplicate 
			$sql = "SELECT * FROM Individuals WHERE EMAIL = '$EMAIL' ";
			$result1 = $conn->query($sql);
		
			if($result1 -> num_rows > 0){ //if email is already registered
				//send error messages here ???????????????????????
				echo 'alert("Already registered!")';
				header("Refresh:0; url=conf_info.html");
			}else{
				// Check if the zipcode exists in the database
				$sql = "SELECT * FROM Address_Details WHERE ZIPCODE = '$ZIPCODE' ";
				$result2 = $conn->query($sql);
			}

			if($result2 -> num_rows == 0){

				// Insert the new address record
				$sql_address = "INSERT INTO Address (STREET, CITY, STATE, ZIPCODE) VALUES ('$STREET', '$CITY', '$STATE' '$ZIPCODE')";
				mysqli_query($conn, $sql_address);

				// Get the last inserted address_id value
				$address_id = mysqli_insert_id($conn);
				$image="image2.jpg";


				$sql_address = "INSERT INTO Individuals (EMAIL, F_NAME, L_NAME, PHONE_NO, PASSWORD, ADDRESS_ID, PROFILE_IMAGE, TYPE, CURRENT_YEAR) VALUES ('$EMAIL', '$FNAME', '$LNAME', '$PHONE', '$PASSWORD', '$address_id', '$image', '$TYPE', '2023'  )"; //grab current year from user in previous html page
				mysqli_query($conn, $sql_address);
				

			}
			
		
		}else if($type=="option2"){

			$_FILES = $_POST['file'];

			// Check if user as already registered, to prevent duplicate 
			$sql = "SELECT * FROM Presenters WHERE EMAIL = '$EMAIL' ";
			$result1 = $conn->query($sql);

			if($result1 -> num_rows > 0){ //if email is already registered
				//send error messages here ???????????????????????
				echo 'alert("Already registered!")';
				header("Refresh:0; url=conf_info.html");
			}else{
				// Check if the zipcode exists in the database
				$sql = "SELECT * FROM Address_Details WHERE ZIPCODE = '$ZIPCODE' ";
				$result2 = $conn->query($sql);
			}

			if($result2 -> num_rows == 0){

				// Insert the new address record
				$sql_address = "INSERT INTO Address (STREET, CITY, STATE, ZIPCODE) VALUES ('$STREET', '$CITY', '$STATE' '$ZIPCODE')";
				mysqli_query($conn, $sql_address);

				// Get the last inserted address_id value
				$address_id = mysqli_insert_id($conn);
				$image="image2.jpg";
				

				$sql_address = "INSERT INTO Presenters (EMAIL, F_NAME, L_NAME, PHONE_NO, PASSWORD, ADDRESS_ID, PROFILE_IMAGE, TYPE, CURRENT_YEAR) VALUES ('$EMAIL', '$FNAME', '$LNAME', '$PHONE', '$PASSWORD', '$address_id', '$image', '$TYPE', '2023'  )"; //grab current year from user in previous html page
				mysqli_query($conn, $sql_address);

				#retrieve file title
				$title = $_POST["title"];
     
				#file name with a random number so that similar dont get replaced
				$pname = rand(1000,10000)."-".$_FILES["file"]["name"];
			 
				#temporary file name to store file
				$tname = $_FILES["file"]["tmp_name"];
			   
				 #upload directory path
				$uploads_dir = 'presenter_files';

				#TO move the uploaded file to specific location
				move_uploaded_file($tname, $uploads_dir.'/'.$pname);

				$file_id = rand(1000, 1000000000);
 
				#sql query to insert into database
				$sql = "INSERT into Presenter_Files(FILE_ID, FILE_NAME, EMAIL) VALUES('$file_id','$title', '$EMAIL')";
			 
				if(mysqli_query($conn,$sql)){
			 
				echo "File Sucessfully uploaded";
				}
				else{
					echo "Error";
				}
			}


		}else if($type=="option3"){

			$Group_Num=$_POST['numUsers'];

			for ($x = 0; $x <= $Group_Num; $x++) {



				


				
			  }
			//collect info, and mark as register
		}else{
			


		}

	}else{
		//user was not logged in 

		header('Location: login(front).html' );


	}
	 
	// Close connection
	mysqli_close($link);
?>