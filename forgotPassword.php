<?php
include("./api/dBConnect.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link  rel="stylesheet" href="login.css">

</head>
<body>
<?php
// If the user submits the form to reset their password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    // Check if the submitted security pin is correct
    $security_pin = $_POST["security_pin"];
    $email = $_POST["email"];

    $query = "SELECT * FROM Members WHERE EMAIL='$email' AND SECURITY_PIN=$security_pin";
    $result = mysqli_query($conn, $query);
   
    if (mysqli_num_rows($result) == 1) {
        // Security pin is correct, show the form to reset password
	unset($_GET['error']);
	echo '<div class="d-flex justify-content-center align-items-center vh-100">';
        echo '<form method="post" class="shadow w-450 p-3" action="./api/updatePassword.php">';
        echo '<h2>Reset Password</h2>';
	if(isset($_GET['error'])){ 
    	echo '<div class="alert alert-danger" role="alert">';
    	echo $_GET['error'];
    	echo '</div>';
	unset($_GET['error']); // clear the error message
        }
	if(isset($_GET['success'])){ 
    	echo '<div class="alert alert-success" role="alert">';
    	echo $_GET['success'];
    	echo '</div>';
	unset($_GET['success']); // clear the error message
        }
	echo '<input type="hidden" name="email" value="' . $email . '">';
	echo '<label for="new_password">New Password:</label>';
        echo '<input type="password"
		     name="new_password" 
		     class="form-control"
		     required>';
        echo '<label for="confirm_password">Confirm Password:</label>';
        echo '<input type="password" 
		     class="form-control"
 		     name="confirm_password" 
		     required>';
        echo '<button>Submit</button>';
	echo '<a href="./api/login.php">Login</a>';
        echo '</form>';
	echo '</div>';
    } else {
        // Security pin is incorrect, show error message
	$err="Incorrect Input, please try again.";
	header("Location: forgotPassword.php?error=$err");
	exit;
    }

} else {
    // Show the form to enter security pin
    echo '<div class="d-flex justify-content-center align-items-center vh-100">';
    echo '<form method="post" class="shadow w-450 p-3" action="">';
    echo '<h2>Forgot Password?</h2>';
    if(isset($_GET['error'])){ 
    echo '<div class="alert alert-danger" role="alert">';
    echo $_GET['error'];
    echo '</div>';
    unset($_GET['error']); // clear the error message
    }
    echo '<label for="email">Email:</label>';
    echo '<input type="email"
		 name="email" 
		 class="form-control"
		 required>';
    echo '<label for="security_pin">Security Pin:</label>';
    echo '<input type="number"
		 name="security_pin" 
		 class="form-control"
		 required>';
    echo '<button>Submit</button>';
    echo '</form>';
    echo '</div>';

}
?>