<?php
/* Připojení k databázi */
session_start();
#db_
$con = mysqli_connect("localhost","root","root","signup");
if($conn === false){
	die("ERROR: Could not connect." . mysqli_connect_error());
}