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
		$query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
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

  	
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >

		<input type ="text" name="name" class ="form-control" placeholder ="Enter Name" maxlength="50" value="<?php echo $name ?>"  />
	    <span class = "text-danger"> <?php echo $nameErr; ?> </span >       

	    <input   type = "email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />    
	    <span   class="text-danger" > <?php   echo  $emailErr; ?> </span >  
        
	    <input type="password" name="passw" class="form-control" placeholder="Enter Password" maxlength="15"  /> 
	    <span class="text-danger" > <?php   echo  $passErr; ?> </span >      
	    <hr />
	          
	    <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button >
	    <hr/>
	  
	    <a href="index.php">Sign in Here...</a>
   </form >

</body>
</html>
<?php  ob_end_flush(); ?>