<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link  rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
    
    <div class="d-flex justify-content-center align-items-center vh-100"> 
        
        <form class="shadow w-450 p-3" method="post" action="./api/login.php" >
	<h1>LOGIN </h1>
        <a href="registerM.php" style="text-decoration: none;">Don't have an account?</a>
        <?php if(isset($_GET['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $_GET['error']; ?>
                </div>
         <?php } 
        ?>  
        <div class="mb-3">    
            <input
                type="email"
                id="email"
                name="myEmail"
                placeholder="Email"
                class="halfForm"
                required 
            />
        </div>
        <div class="mb-3">
            <input
                type="password"
                id="password"
                name="myPassword"
                class="form-control"
                placeholder="Password" 
                required
            />
        </div>
        <div class="mb-3">
            <select class="form-control" name="myAdmin">
                <option>Admin Login</option>
                <option value="Y">YES</option>
                <option value="N">NO</option>
            </select>
        </div> 
            <button>Submit</button>
	<div class="forgotPassword">
            <a href="forgotPassword.php">Forgot Password?</a>
        </div>
        </form>
        
    </div>
</body>
</html>