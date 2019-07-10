<?php 

require_once 'db_connect.php';

if ($_POST) {
   $id = $_POST['bookingId'];

   $sql = "DELETE FROM bookings WHERE bookingId = {$id}";
    if($connect->query($sql) === TRUE) {
       echo "<p>Successfully deleted!!</p>" ;
       echo "<a href='../rentalactive.php'><button type='button'>Back</button></a>";
   } else {
       echo "Error updating record : " . $connect->error;
   }

   $connect->close();
}

?>