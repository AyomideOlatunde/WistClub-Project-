<?php
	//activate the created session to be used on this page
	session_start();
	//deactivate session if for some reason there is no session variable
    	if(!$_SESSION['email']|| $_SESSION['userRole']!='Admin'){
    	    header('Location: ../index.php'); //redirect to home page
            die(); //destroy session
    	}

	//deactivate the session if for some reason it's no longer valid
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="home.css">
    <title>WIST Club Website</title>
</head>
<body>
<?php
        echo '<button onclick="window.location.href=\'../api/logout.php\'">LOGOUT</button>';
	echo '<button onclick="window.location.href=\'usersInfo.php\'">Users</button>';
	echo '<img onclick="window.location.href=\'../profile.php\'" src="../ProfileImages/'.$_SESSION['profileImage'].'" class="rounded-circle" style="width: 70px">';

    ?>
</body>
</html>