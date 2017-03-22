<?php
	ob_start();
	session_start();
	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
	}
	include_once ($_SERVER['DOCUMENT_ROOT'].'/dbconnect.php');

	$error = false;

	if ( isset($_POST['btn-signup']) ) {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		// basic name validation
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter a username.";
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Username must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Username must contain alphabets and space.";
		}else{
            $query = "SELECT userName FROM users WHERE userName='$name'";
            $result = $conn->query($query);
            $count = $result->num_rows;
            if($count!=0){
                $error = true;
                $nameError = "Provided username is already in use.";
            }
        }
		
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
			// check email exist or not
			$query = "SELECT userEmail FROM users WHERE userEmail='$email'";
			$result = $conn->query($query);
			$count = $result->num_rows;
			if($count!=0){
				$error = true;
				$emailError = "Provided Email is already in use.";
			}
		}
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
		}
		
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		
		// if there's no error, continue to signup
		if( !$error ) {
			
			$query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
			$res = $conn->query($query);
				
			if ($res) {
			    $sql = 'SELECT * FROM `users` WHERE userName="' . $name . '"';
                $result = $conn->query($sql);
                $user = $result->fetch_assoc();
                if ($result->num_rows >= 1) {
                    if(substr($name, -1) == "s"){
                        $planetname = $name + "\' planet";
                    }else{
                        $planetname = $name + "s planet";
                    }
                    $sql = "INSERT INTO `planets` (owner, name, steel_produce, steel_storage, aluminium_produce, aluminium_storage, uranium_produce, uranium_storage, orbital_defense, shipyard, farms, population) VALUES ("
                        . $user["userId"] . ",'" . $planetname . "',1,200,1,200,0,0,1,1,1,500)";

                    if ($conn->query($sql) === TRUE) {
                        $errTyp = "success";
                        $errMSG = "Successfully registered, you may login now";
                        unset($name);
                        unset($email);
                        unset($pass);
                        echo "<script>alert('Successfully Registered'); window.location = '/index.php';</script>";
                    } else {
                        $errTyp = "danger";
                        $errMSG = "Something went wrong, try again later... Errorcode: 3.0";
                    }
                } else {
                    $errTyp = "danger";
                    $errMSG = "Something went wrong, try again later... Errorcode: 2.0";
                }
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later... Errorcode: 1.0";
			}	
				
		}
		
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SpaceW</title>
    <link rel="icon" href="/images/icon.png">
<link rel="stylesheet" href="/assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="/assets/login_style.css" type="text/css" />
</head>
<body>

<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Sign Up.</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="name" class="form-control" placeholder="Enter Username" maxlength="50" value="<?php echo isset($name) ? $name : "" ?>" />
                </div>
                <span class="text-danger"><?php echo isset($nameError) ? $nameError : ""; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo isset($email) ? $email : "" ?>" />
                </div>
                <span class="text-danger"><?php echo isset($emailError) ? $emailError : ""; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo isset($passError) ? $passError : ""; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<a href="/index.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>