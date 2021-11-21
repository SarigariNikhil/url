<?php  

$sname = "remotemysql.com";
$uname = "yHaeXaibMm";
$password = "6DWT9cEqdt";

$db_name = "yHaeXaibMm";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
	exit();
}