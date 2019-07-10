<!DOCTYPE html>
<html>
<head>
   <title>PHP CRUD  |  Add User</title>

   <style type= "text/css">
       fieldset {
           margin: auto;
            margin-top: 100px;
           width: 50% ;
       }

       table tr th  {
           padding-top: 20px;
       }
   </style>

</head>
<body>

<fieldset>
   <legend>Book Car</legend>

   <form  action="actions/a_create.php" method= "post">
       <table cellspacing= "0" cellpadding="0">
           <tr>
               <th>Car Model</th>
               <td><input  type="text" name="carModel"  placeholder="your DREAM car" /></td>
           </tr>     
           <tr>
               <th>From</th>
               <td><input  type="date" name= "fromDate" placeholder="" /></td>
           </tr>
           <tr>
               <th>To</th>
               <td><input type="date"  name="toDate" placeholder ="" /></td>
           </tr>
           <tr>
               <td><button type ="submit">Book!</button></td>
               <td ><a href= "index.php"><button  type="button">Back</button></a></td>
           </tr>
       </table>
   </form>

</fieldset>

</body>
</html>