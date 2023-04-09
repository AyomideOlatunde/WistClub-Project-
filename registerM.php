<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./api/adminValidation.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link  rel="stylesheet" href="register.css">
    <title>Document</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100"> 
        
        <form name="register" onsubmit="return validateStaff()" class="shadow w-450 p-3" method="post" action="./api/register.php" enctype="multipart/form-data">
            <h2>Create Account</h2>
	    <?php if(isset($_GET['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $_GET['error']; ?>
                </div>
                <?php } ?>
    
            <span class="d-flex justify-content-center ">
            <div class="mb-3">
                <input
                    type="text"
                    id="firstname"
                    name="f_Name"
                    placeholder="First Name"
                    class="form-control"
                    required
                />
            `</div>
            <div class="mb-3">
                <input
                    type="text"
                    id="lastname"
                    name="l_Name"
                    placeholder="Last Name"
                    class="form-control"
                    required 
                />
            </div>
        </span>
        <div class="mb-3">
            <input
                type="text"
                id="email"
                name="Email"
                class="form-control"
                placeholder="Email"
                required
            />
        </div>
        <span class="d-flex justify-content-center ">
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                placeholder="phone: ###-###-####"
                name="Phone"
                id="phoneno"
                required
            />
        </div>
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                placeholder="State"
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
                placeholder="Street"
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
                placeholder="City"
                name="City"
                id="City"
                required
            />
        </div>
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                placeholder="Zipcode"
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
                placeholder="Password"
                name="Password"
                id="pwd"
                required
            />
        </div>
            <div class="mb-3">
                <input
                    type="password"
                    class="form-control"
                    placeholder="Confirm Password"
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
             </div>
              <span class="d-flex justify-content-center ">
                <div class="mb-3">
                <select name="Admin" class="form-control" required>
                    <option>Admin SignUp</option>
                    <option value="Y">YES</option>
                    <option value="N">NO</option>
                </select>
                </div>
                <div class="mb-3">
                
                <input type="number" 
		           class="form-control"
                   	   placeholder="Security Pin"
		           name="security_pin"/>
             </div>
             </span>            <button>Submit</button>
            <a href="loginM.php" class="link-secondary">Login</a>
        </form>
        
    </div>
</body>
</html>