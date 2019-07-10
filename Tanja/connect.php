<?php error_reporting(~E_NOTICE && ~E_DEPRECATED);

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'test_db');


$conn = (mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME));

if(!conn){
	die("Failed to connect: " . msqli_connect_error());
}

?>