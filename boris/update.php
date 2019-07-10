<?php 

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
   <title >Edit User</title>

   <style type= "text/css">
       fieldset {
           margin : auto;
           margin-top: 100px;
            width: 50%;
       }

       table  tr th {
           padding-top: 20px;
       }
   </style>

</head>
<body>

<fieldset>
   <legend>Update Booking</legend>

   <form action="actions/a_update.php"  method="post">
       <table  cellspacing="0" cellpadding= "0">
           <tr>
               <th>Car Model</th>
               <td><input type="text"  name="carModel" placeholder ="First Name" value="<?php echo $data['carModel'] ?>"  /></td>
           </tr >     
           <tr>
               <th>From Date</th>
               <td><input type= "date" name="fromDate"  placeholder="Last Name" value ="<?php echo $data['fromDate'] ?>" /></td >
           </tr>
           <tr>
               <th >To Date</th>
               <td><input type ="date" name= "toDate" placeholder= "Date of birth" value= "<?php echo $data['toDate'] ?>" /></td>
           </tr> 
           <tr>
               <input type= "hidden" name= "bookingId" value= "<?php echo $data['bookingId']?>" />
               <td><button  type= "submit">Save Changes</button></td>
               <td><a  href= "index.php"><button  type="button" >Back</button></a ></td >
           </tr>
       </table>
   </form >

</fieldset >

</body >
</html >

<?php 
}
?>