<?php
    session_start();

    //deactivate session if for some reason there is no session variable
    if(!$_SESSION['email'] || $_SESSION['userRole']!='Admin'){
        header('Location: ../index.php'); //redirect to home page
        die(); //destroy session
    }

    include("../api/dBConnect.php");
    include("../config/config.php");
    $email = $_GET['email'];
    $ADDRESS_ID = $_GET['ADDRESS_ID'];

    $mem = "SELECT * FROM Members WHERE EMAIL='$email'" ;
    $memRow = $conn->query($mem);
    $memResult = $memRow->fetch_assoc();
    $add = "SELECT * FROM Address WHERE ADDRESS_ID='$ADDRESS_ID'" ;
    $addRow = $conn->query($add);
    $addResult = $addRow->fetch_assoc();

    $EMAIL=$email;
    $F_NAME=$memResult['F_NAME'];
    $L_NAME=$memResult['L_NAME'];
    $PHONE=$memResult['PHONE_NO'];
    $CITY=$addResult['CITY'];
    $STREET=$addResult['STREET'];
    $ZIPCODE=$addResult['ZIPCODE'];
    $STATE=$addResult['STATE'];
    $PASSWORD=openssl_decrypt($memResult['PASSWORD'], ENCRYPTION_METHOD, SECRET_KEY);
    $SECURITY_PIN=$memResult['SECURITY_PIN'];
    $PROFILE_IMAGE=$memResult['PROFILE_IMAGE'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link  rel="stylesheet" href="../register.css">
    <link  rel="stylesheet" href="../profile.css">
    <title>Edit Profile</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100"> 
        
        <form class="shadow w-450 p-3" method="post" action="editMembers.php" enctype="multipart/form-data">
            <h2>Update Account</h2>
	    <?php if(isset($_GET['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $_GET['error']; ?>
                </div>
                <?php } ?>
    
                <?php if(isset($_GET['success'])){ ?>
                <div class="alert alert-success" role="alert">
                  <?php echo $_GET['success']; ?>
                </div>
                <?php } 
            ?>
            <span class="d-flex justify-content-center ">
            <div class="mb-3">
                <input
                    type="text"
                    id="firstname"
                    name="f_Name"
                    value="<?php echo $F_NAME?>"
                    class="form-control"
                    required
                />
            `</div>
            <div class="mb-3">
                <input
                    type="text"
                    id="lastname"
                    name="l_Name"
                    value="<?php echo $L_NAME?>"
                    class="form-control"
                    required 
                />
            </div>
        </span>
        <div class="mb-3">
            <label class="form-control"><?php echo $EMAIL?></label>
        </div>
        <span class="d-flex justify-content-center ">
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                value="<?php echo $PHONE?>"
                name="Phone"
                id="phoneno"
                required
            />
        </div>
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                value="<?php echo $STATE?>"
                name="State"
                id="State"
                required
            />
        </div>
        </span>
        <div class="mb-3"> 
            <input
                type="text"
                class="form-control"
                value="<?php echo $STREET?>"
                name="Street"
                id="street"
                required
            />
        </div>
        <span class="d-flex justify-content-center ">
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                value="<?php echo $CITY?>"
                name="City"
                id="City"
                required
            />
        </div>
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                value="<?php echo $ZIPCODE?>"
                name="Zipcode"
                id="Zipcode"
                required
            />
        </div>
        </span>
        <span class="d-flex justify-content-center ">
        <div class="mb-3">  
            <input
                type="password"
                class="form-control"
                value="<?php echo $PASSWORD?>"
                name="Password"
                id="pwd"
                required
            />
        </div>
            <div class="mb-3">
                <input
                    type="password"
                    class="form-control"
                    value="<?php echo $PASSWORD?>"
                    id="confirmpwd"
                    name="CPassword"
                    required
                />
            </div>
            </span>
            <div class="mb-3">
                
                <input type="file" 
		           class="form-control"
		           name="profilePic"/>
                   <img src="../ProfileImages/<?=$PROFILE_IMAGE?>"
                 class="rounded-circle"
                 style="width: 70px">
            <input type="text"
                   hidden="hidden" 
                   name="old_pp"
                   value="<?=$PROFILE_IMAGE?>" > 
             </div>
	     <div class="mb-3">
		<input type="number"
			class="form-control"
			name="security_pin"
			value="<?php echo $SECURITY_PIN?>"
			required/>
	    </div>
        <input type="hidden" name="ADDRESS_ID" value="<?php echo $ADDRESS_ID; ?>">
            <button>Submit</button>
       </form>
       
    </div>
</body>
</html>

		
        
        
        
        
        