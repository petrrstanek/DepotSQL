<?php
session_start();
/*$conn = mysqli_connect("localhost", "root", "root", "attendance");*/
$conn = mysqli_connect("127.0.0.1", "portfolioapps.cz", "9ob88eWJq9ie", "portfolioappscz3");
if($conn === false){
	echo "Failed to connect" . mysqli_connect_error();
}

$user_att = mysqli_query($conn, "SELECT email, log FROM logs WHERE id_user={$_SESSION['id']}");
while($row = mysqli_fetch_array($user_att)){
	echo $row['email'] . "<br>";
	echo $row['log'] . "<br>";
}