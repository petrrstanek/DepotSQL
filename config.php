<?php
session_start();
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'root';
$db_name = 'signup';

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if(mysqli_connect_errno()){
	die('Failed to connect to MySQL:' . mysqli_connect_error());
}
