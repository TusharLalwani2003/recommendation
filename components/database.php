<?php 

$dpHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "recommendation";

$conn = mysqli_connect($dpHost, $dbUser, $dbPass, $dbName);

if(!$conn) {
	die("Database connectivity Failed");
}

?>