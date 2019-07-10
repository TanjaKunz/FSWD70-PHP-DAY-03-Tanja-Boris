<?php
ob_start();
session_start();

require_once 'connect.php';

// if(!isset($_SESSION['user'])){
// 	header('Location: index.php');
// 	exit;
// }

$query = mysqli_query($conn, "SELECT * FROM users WHERE userId = ".$_SESSION['user']);
$userRow = mysqli_fetch_array($query, MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome <?= $userRow['userName']; ?></title>
</head>
<body>
	<?php if(isset($_SESSION['user'])){ ?>

		<div class="fixed-top text-align-right">
			<img src="<?= $userRow['userImg'] ?>">
			<div> <?= $userRow['userName'] ?> </div>
		</div>

	<?php } ?>


	<div>Hello <?= $userRow['userName']; ?> </div>
	<br>
	<a href="logout.php?logout">Sign Out</a>



</body>
</html>
<?php ob_end_flush() ?>