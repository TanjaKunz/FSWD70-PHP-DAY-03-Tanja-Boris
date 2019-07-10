<?php
ob_start();
session_start(); // start a new session or continues the previous
if( isset($_SESSION['user'])!="" ){
 header("Location: rentalactiveuser.php" ); // redirects to home.php
}
include_once 'dbconnect.php';
$error = false;
if ( isset($_POST['btn-signup']) ) {
 
 // sanitize user input to prevent sql injection
 $name = trim($_POST['name']);

  //trim - strips whitespace (or other characters) from the beginning and end of a string
  $name = strip_tags($name);

  // strip_tags — strips HTML and PHP tags from a string

  $name = htmlspecialchars($name);
 // htmlspecialchars converts special characters to HTML entities
 $email = trim($_POST[ 'email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);

  // basic name validation
 if (empty($name)) {
  $error = true ;
  $nameError = "Please enter your full name.";
 } else if (strlen($name) < 3) {
  $error = true;
  $nameError = "Name must have at least 3 characters.";
 } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
  $error = true ;
  $nameError = "Name must contain alphabets and space.";
 }

 //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address." ;
 } else {
  // checks whether the email exists or not
  $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);
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
  $passError = "Password must have atleast 6 characters." ;
 }

 // password hashing for security
$password = hash('sha256' , $pass);


 // if there's no error, continue to signup
 if( !$error ) {
  
  $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
  $res = mysqli_query($conn, $query);
  
  if ($res) {
   $errTyp = "success";
   $errMSG = "Successfully registered, you may login now";
   unset($name);
    unset($email);
   unset($pass);
  } else  {
   $errTyp = "danger";
   $errMSG = "Something went wrong, try again later..." ;
  }
  
 }


}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Borsi's Extravagant Rentals . COM come get C A R S </title>
	<link rel="stylesheet" type="text/css" href="ex1.css">
	 <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript" charset="utf-8" async defer></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8" async defer></script>
 <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/bc0a20296a.js"></script>

</head>
<body>
	<div class="container-fluid">
	<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
  <a class="navbar-brand text-danger " href="#">Borsi's Extravagant Rentals</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Rentals</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Locations</a>
      </li>
      <li class="nav-item active signin">
        <a class="nav-link text-danger" href="index.php">Sign in!</a>
      </li>
    </ul>
  </div>
</nav>
<div class="jumbotron jumbotron-fluid shadow bg-danger">
	<div class="container ">
	<img class ="hero" src="https://www.priceline.com/drive/landing/public/assets/images/3_Cars_Astra@2x.1d9e4a8bf70f877bbd95d38919a0b00b.webp">
	<div class="container">
    <h1 class="display-3 ">Borsi's Extravagant Rentals</h1>
    <p class="lead ">Come get your CARS here baby! We have the best cars on this side of the mississipi!</p>
  </div>
	</div>
</div>
<div class="container-fluid shadow">
	<div class="head d-flex justify-content-center">
		<h2 class="text-danger display-3">Our offer:</h2>
	</div>
	<div class="container-fluid d-flex justify-content-between mb-5">
	<div class="offer border border-danger rounded mt-5 container-fluid mb-5" >
		<i class="fas fa-check-circle mt-5 mb-4"></i>
		<p class="text-danger text-center">Get Insured by our Trusted Insurances for best Coverage!</p>
	</div>
	<div class="offer border border-danger rounded mt-5 container-fluid mb-5">
		<i class="fas fa-tasks mt-5 mb-4"></i>
		<p class="text-danger text-center">Let our Experienced Staff assist you in Choosing the Perfect Vehicle!</p>
	</div>
	<div class="offer border border-danger rounded mt-5 container-fluid mb-5">
		<i class="fas fa-euro-sign mt-5 mb-4"></i>
		<p class="text-danger text-center">Unrivaled Prices & Service!</p>
	</div>
	</div>
</div>
<div class="container">
	<div class="head">
		<h1 class="display-4 text-danger text-center">What Are you waiting for? Sign up now!</h1>


 <?php
   if ( isset($errMSG) ) {
  
 ?> 
     <div  class="alert alert-<?php echo $errTyp ?>" >
        <?=  $errMSG; ?>
     </div>

<?php 
  }
  ?>

	</div>
	<div class="container">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="container">
  <div class="form-group">
    <label for="formGroupExampleInput">Name</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter Name" name="name" value="<?= $name ?>" maxlength ="50">
     <span   class = "text-danger" > <?php   echo  $nameError; ?> </span >
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Email</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Enter Email" name="email" value ="<?= $email ?>" maxlength ="50">
     <span   class = "text-danger" > <?php   echo  $emailError; ?> </span >
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Password</label>
    <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Enter Password" name="pass" maxlength="15">
    <span   class = "text-danger" > <?php   echo  $passError; ?> </span >
  </div>
  <div class="d-flex justify-content-center mb-5">
  <input type="submit"  class="btn btn-danger shadow" name="btn-signup">
  </div>
</form>
</div>
</div>

	</div>

</body>
</html>
<?php  ob_end_flush(); ?>