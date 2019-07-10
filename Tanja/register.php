<?php
ob_start();
session_start();

include_once 'connect.php';

if( isset($_SESSION['user'])!="" ){
 header("Location: home.php" );
}

$error = false;

if (isset($_POST['btn-signup']) ) {
 

$name = trim($_POST['name']);
$name = strip_tags($name);
$name = htmlspecialchars($name);

$email = trim($_POST['email']);
$email = strip_tags($email);
$email = htmlspecialchars($email);

$passw = trim($_POST['passw']);
$passw = strip_tags($passw);
$passw = htmlspecialchars($passw);

$pic = trim($_POST['pic']);
$pic = strip_tags($pic);
$pic = htmlspecialchars($pic);

	if (empty($name)) {
		$error = true ;
		$nameErr = "Please enter your full name.";
	} else if (strlen($name) < 3) {
		$error = true;
		$nameErr = "Name must have at least 3 characters.";
	} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true ;
		$nameErr = "Name must contain alphabets and space.";
	}


	if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
		$error = true;
		$emailErr = "Please enter valid email address." ;
	} else {
		$query = "SELECT userEmail FROM users WHERE userEmail='$email'";
		$result = mysqli_query($conn, $query);
		$count = mysqli_num_rows($result);
		if($count!=0){
			$error = true;
			$emailErr = "Provided Email is already in use.";
		}
	}
 
	if (empty($passw)){
		$error = true;
		$passErr = "Please enter password.";
	} else if(strlen($passw) < 6) {
		$error = true;
		$passErr = "Password must have atleast 6 characters." ;
	}

	$password = hash('sha256' , $passw);

 
	if( !$error ) {  
		$query = "INSERT INTO users(userName,userEmail,userPass, userImg) VALUES('$name','$email','$password', '$pic')";
		$res = mysqli_query($conn, $query);

		if ($res) {
			$errTyp = "success";
			$errMSG = "Successfully registered, you may login now";
			unset($name);
			unset($email);
			unset($passw);
		} else  {
			$errTyp = "danger";
			$errMSG = "Something went wrong, try again later..." ;
	  	}  
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register form</title>

	<!-- Bootstrap -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-------- Font Awesome -------->
  	<script src="https://kit.fontawesome.com/649b84c193.js"></script>

  	<!-- Custom Stylesheet -->
  	<link rel="stylesheet" href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css">

  	
</head>
<body>
	<form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
		<h1 class="h3 mb-3 font-weight-normal">Please register</h1>

		<label>Name</label>
		<input type="text" name="name"  class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name; ?>" autofocus>
		<span class="text-danger"><?php echo $nameErr; ?></span>

		<label>Email</label>
		<input type="email" name="email" class="form-control" placeholder="Enter Your Email"  maxlength="40" value="<?php echo $email; ?>" autofocus>
		<span class="text-danger"><?php echo $emailErr; ?></span>

		<label>Password</label>
		<input type="password" name="passw" id="inputPassword" class="form-control" placeholder="Enter Password" maxlength="15">
		<span class="text-danger"><?php echo $passErr; ?></span>

		<label>URL to your picture</label>
		<input type="pic" name="pic" class="form-control" placeholder="URL" maxlength="15">
		<span class="text-danger"><?php echo $passErr; ?></span><br>	    
	          
	    <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button >
	    <hr/>
	  
	    <a href="index.php">Sign in Here...</a>
   </form >

</body>
</html>
<?php  ob_end_flush(); ?>