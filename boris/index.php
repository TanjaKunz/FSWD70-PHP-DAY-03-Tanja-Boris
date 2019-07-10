<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user'])!="" ) {
 header("Location: rentalactive.php");
 exit;
 
}

$error = false;

if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST[ 'pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);
 // prevent sql injections / clear user invalid inputs 

 if(empty($email)){
  $error = true;
  $emailError = "Please enter your email address.";
 } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address.";
 }

 if (empty($pass)){
  $error = true;
  $passError = "Please enter your password." ;
 }

 // if there's no error, continue to login
 if (!$error) {
  
  $password = hash( 'sha256', $pass); // password hashing

  $res=mysqli_query($conn, "SELECT userId, userName, userPass, rule  FROM users WHERE userEmail='$email'" );
  $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
  $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row 
  
  if( $count == 1 && $row['userPass' ]==$password ) {
    if($row['rule']=='admin'){
      $_SESSION['admin'] = $row['userId'];
      header("Location: rentalactive.php");
    } else {

      $_SESSION['user'] = $row['userId'];
   header( "Location: rentalactiveuser.php");

    }
   
  } else {
   $errMSG = "Incorrect Credentials, Try again..." ;
  }
  
 }

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login & Registration System</title>

 <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript" charset="utf-8" async defer></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8" async defer></script>
 <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/bc0a20296a.js"></script>
  <style>
    .form-control {
      width: 50%;
      margin-left: 25%;
    }

    .btn {
      margin-left: 46%;
    }

  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
  <a class="navbar-brand text-danger " href="rental.php">Borsi's Extravagant Rentals</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="rental.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Rentals</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Locations</a>
      </li>
    </ul>
  </div>
</nav>


   <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
  
    
            <h2 class="display-3 text-center text-danger mt-5">Sign In</h2 >
            <hr />
            
            <?php
  if ( isset($errMSG) ) {
echo  $errMSG; ?>
              
               <?php
  }
  ?>
           
          
            <div class="container shadow-sm"> 
            <input  type="email" name="email"  class="form-control mt-5" placeholder= "Your Email" value="<?php echo $email; ?>"  maxlength="40" />
        
            <span class="text-danger"><?php  echo $emailError; ?></span >
  
          
            <input  type="password" name="pass"  class="form-control mt-3 mb-3" placeholder ="Your Password" maxlength="15"  />
        
           <span  class="text-danger"><?php  echo $passError; ?></span>
            <hr />
            <button class="btn btn-danger" type="submit" name= "btn-login">Sign In</button>
          
          
            <hr />
          </div>
              <div class="container"> 
            <a  class="text-center text-danger " href="rental.php">Sign Up Here...</a>
            </div>
      
          
   </form>
   </div>
</div>
</body>
</html>
<?php ob_end_flush(); ?>