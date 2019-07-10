
<?php
ob_start();
session_start(); // start a new session or continues the previous
if( isset($_SESSION['user'])=="" ){
 header("Location: index.php" ); // redirects to home.php
}
require_once 'actions/db_connect.php'; 
$error = false;

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
        <a class="nav-link text-danger" href="logout.php?logout">Sign Out</a>
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

<div class="container">
	<div class="head">
		<h1 class="display-4 text-danger text-center">Booked Cars</h1>


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
<div class ="manageUser">
   <table  border="1" cellspacing= "0" cellpadding="0" class="table table-hover">
       <thead>
           <tr>
               <th>Car Model</th>
               <th >Pickup Date</th>
               <th >Dropoff Date</th>
               
           </tr>
       </thead>
       <tbody>


         <?php
           $sql = "SELECT * FROM bookings ";
           $result = $connect->query($sql);

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  echo "<tr>
                       <td>" .$row['carModel']." </td>
                       <td>" .$row['fromDate']."</td>
                       <td>" .$row['toDate']."</td>
                   </tr>" ;
               }
           } else  {
               echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
           }
            ?>

            
       </tbody>
   </table>
</div>
</div>

	</div>

</body>
</html>
<?php  ob_end_flush(); ?>