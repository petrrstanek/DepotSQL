<?php
session_start();
$conn = mysqli_connect("localhost","root","root","depot");
if($conn === false){
	die("ERROR: Could not connect." . mysqli_connect_error());
}
$new = $_SESSION['lastid'];


$sql = "DELETE FROM resources WHERE id_record = $new";
if(mysqli_query($conn, $sql)){
header('Location: home.php');
} else{
	echo " ERROR";
}
mysqli_close($conn);