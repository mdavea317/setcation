<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('servername', 'localhost');
define('username', 'root');
define('password', '');
define('dbname', 'lissa');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(servername, username, password, dbname);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>