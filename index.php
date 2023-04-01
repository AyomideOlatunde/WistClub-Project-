<?php
	include("dBConnect.php");
	//activate the created session to be used on this page
	session_start();
	
	//deactivate the session if for some reason it's no longer valid
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="home.css">
    <title>WIST Club Website</title>
</head>
<body>
<?php
        if(!isset($_SESSION['email']))
        {
            echo '<button onclick="window.location.href=\'login.html\'">LOGIN</button>';
        }
        else
        {
            echo '<button onclick="window.location.href=\'logout.php\'">LOGOUT</button>';
			echo '<button onclick="window.location.href=\'deleteAccount.php\'">Delete Account</button>';
        }
    ?>
</body>
</html>