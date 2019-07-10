<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user' ]) ) {
 header("Location: index.php");
 exit;
}
// select logged-in users details 
$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['userEmail' ]; ?></title>
<style>
	h3 {
		margin-left :  60%;
	}
	
</style>
</head>
<body >
         <h3>  Hi <?php echo $userRow['userName' ]; ?> </h3>
            
           <a  href="logout.php?logout">Sign Out</a>
  
        
  
</body>
</html>
<?php ob_end_flush(); ?>