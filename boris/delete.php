<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require_once 'actions/db_connect.php';

if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM bookings WHERE bookingId = {$id}" ;
   $result = $connect->query($sql);
   $data = $result->fetch_assoc();

   $connect->close();
?>

<!DOCTYPE html>
<html>
<head>
   <title >Delete User</title>
</head>
<body>

<h3>Do you really want to cancel your booking?</h3>
<form action ="actions/a_delete.php" method="post">

   <input type="hidden" name= "bookingId" value="<?php echo $data['bookingId'] ?>" />
   <button type="submit">Yes, cancel it!</button >
   <a href="index.php"><button type="button">No, go back!</button ></a>
</form>

</body>
</html>

<?php
}
?>