
<?php 

require_once 'db_connect.php';

if ($_POST) {
   $car = $_POST['carModel'];
   $from = $_POST['fromDate'];
   $to = $_POST[ 'toDate'];

   $sql = "INSERT INTO bookings (carModel, fromDate, toDate) VALUES ('$car', '$from', '$to')";
    if($connect->query($sql) === TRUE) {
       echo "<p>New Record Successfully Created</p>" ;
       echo "<a href='../create.php'><button type='button'>Back</button></a>";
        echo "<a href='../index.php'><button type='button'>Home</button></a>";
   } else  {
       echo "Error " . $sql . ' ' . $connect->connect_error;
   }

   $connect->close();
}

?>