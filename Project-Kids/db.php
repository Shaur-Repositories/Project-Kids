<?php
define('HOSTNAME','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','PASSWORD');
define('DB_NAME', 'user');

//global $con;
$con = mysqli_connect(HOSTNAME, DB_USERNAME,"", DB_NAME) or die ("error");
// Check connection
if(mysqli_connect_errno($con))	echo "Failed to connect MySQL: " .mysqli_connect_error();
?>
