<?php 

require_once 'db_connect.php';

if ($_POST) {
   $carModel = $_POST['carModel'];
   $from = $_POST['fromDate'];
   $to = $_POST[ 'toDate'];

   $id = $_POST['bookingId'];

   $sql = "UPDATE bookings SET carModel = '$carModel', fromDate = '$from', toDate = '$to' WHERE bookingId = {$id}" ;
   if($connect->query($sql) === TRUE) {
       echo  "<p>Successfully Updated</p>";
       echo "<a href='../update.php?id=" .$id."'><button type='button'>Back</button></a>";
       echo  "<a href='../index.php'><button type='button'>Home</button></a>";
   } else {
        echo "Error while updating record : ". $connect->error;
   }

   $connect->close();

}

?>