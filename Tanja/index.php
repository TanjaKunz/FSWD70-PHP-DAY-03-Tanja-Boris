<?php
ob_start();
session_start();

require_once 'connect.php';

if(isset($_SESSION['username']) != ""){
	header('Location: home.php');
	exit;
}

$error = false;

if(isset($_POST['btn-login'])){

	//define variables and clean them of whitespaces, entities, tags
	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$passw = trim($_POST['passw']);
	$passw = strip_tags($passw);
	$passw = htmlspecialchars($passw);

	//checking email
	if(empty($email)){
		$error = true;
		$emailErr = "Please enter your email address.";
	} elseif ( !filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error = true;
		$emailErr = "Please enter valid email address.";
	}

	//checking password
	if(empty($passw)){
		$error = true;
		$passErr = "Please enter your password.";
	}

	//in case of no error, login procedure
	if(!$error){
		$password = hash( 'sha256', $passw);

		$query = mysqli_query($conn, "SELECT userId, userName, userPass FROM users WHERE userEmail = '$email'");
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		$count = mysqli_num_rows($query);

		if($count == 1 && $row['userPass'] == $password){
			$_SESSION['user'] = $row['userId'];
			header("Location: home.php");
		} else {
			$errMSG = "Incorrect Credentials, Please try again...";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sign in</title>


	<!-- Bootstrap -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-------- Font Awesome -------->
  	<script src="https://kit.fontawesome.com/649b84c193.js"></script>

  	<!-- Custom Stylesheet -->
  	<link rel="stylesheet" href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css">
</head>
<body>
	<form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  
  <?php if($errMSG){
  	echo $errMSG;
  } ?>

  <label class="sr-only">Email address</label>
  <input type="email" name="email"  class="form-control" placeholder="Email address" value="<?php echo $email; ?>" autofocus>
  <span class="text-danger"><?php echo $emailErr; ?></span>

  <label class="sr-only">Password</label>
  <input type="password" name="passw" id="inputPassword" class="form-control" placeholder="Password">
  <span class="text-danger"><?php echo $passErr; ?></span>
  
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-login">Sign in</button>
</form>
<br>
<a  href="register.php">Sign Up Here...</a>



</body>
</html>
<?php ob_end_flush(); ?>