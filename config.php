<?php
session_start();
						
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "setcation";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

date_default_timezone_set("Asia/Manila");

?>