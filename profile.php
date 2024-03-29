<?php
    session_start();

    //deactivate session if for some reason there is no session variable
    if(!$_SESSION['email']){
        header('Location : index.php'); //redirect to home page
        die(); //destroy session
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link  rel="stylesheet" href="register.css">
    <link  rel="stylesheet" href="profile.css">
    <title>Document</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100"> 
        
        <form class="shadow w-450 p-3" method="post" action="./api/updateProfile.php" enctype="multipart/form-data">
            <h2>Profile Info</h2>
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
                    value="<?php echo $_SESSION['fname']?>"
                    class="form-control"
                    required
                />
            `</div>
            <div class="mb-3">
                <input
                    type="text"
                    id="lastname"
                    name="l_Name"
                    value="<?php echo $_SESSION['lname']?>"
                    class="form-control"
                    required 
                />
            </div>
        </span>
        <div class="mb-3">
            <label class="form-control"><?php echo $_SESSION['email']?></label>
        </div>
        <span class="d-flex justify-content-center ">
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                value="<?php echo $_SESSION['phoneno']?>"
                name="Phone"
                id="phoneno"
                required
            />
        </div>
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                value="<?php echo $_SESSION['state']?>"
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
                value="<?php echo $_SESSION['street']?>"
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
                value="<?php echo $_SESSION['city']?>"
                name="City"
                id="City"
                required
            />
        </div>
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                value="<?php echo $_SESSION['zipcode']?>"
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
                value="<?php echo $_SESSION['password']?>"
                name="Password"
                id="pwd"
                required
            />
        </div>
            <div class="mb-3">
                <input
                    type="password"
                    class="form-control"
                    value="<?php echo $_SESSION['password']?>"
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
		<img src="ProfileImages/<?=$_SESSION['profileImage']?>"
                 class="rounded-circle"
                 style="width: 70px">
            <input type="text"
                   hidden="hidden" 
                   name="old_pp"
                   value="<?=$_SESSION['profileImage']?>" > 
             </div>
            <div class="mb-3">
		<input type="number"
			class="form-control"
			name="security_pin"
			value="<?php echo $_SESSION['security_pin']?>"
			required/>
	    </div>
            <button>Submit</button>
       </form>
        <button id="deleteButton" >Delete Account</button>

        <!-- HTML markup for the popup -->
        <div id="deletePopup">
            <p class="title" >Are you sure you want to delete your account?</p>
            <div className="footer">
                <button id="confirmDelete">Yes</button>
                <button id="cancelDelete">No</button>
            </div>
        </div>
	

        <!-- JavaScript code to show and hide the popup -->
        <script>
            const deleteButton = document.getElementById('deleteButton');
            const deletePopup = document.getElementById('deletePopup');
            const confirmDeleteButton = document.getElementById('confirmDelete');
            const cancelDeleteButton = document.getElementById('cancelDelete');
	
            deleteButton.addEventListener('click', () => {
            deletePopup.style.display = 'block';
            });

            cancelDeleteButton.addEventListener('click', () => {
            deletePopup.style.display = 'none';
            });

            confirmDeleteButton.addEventListener('click', () => {
            // delete the item here
            	window.location.href='./api/deleteAccount.php';
            });
        </script> 
    </div>
</body>
</html>

		
        
        
        
        
        