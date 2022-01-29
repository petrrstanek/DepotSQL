<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

session_start();
/*$conn = mysqli_connect("localhost", "root", "root", "depot");*/
$conn = mysqli_connect("127.0.0.1", "portfolioapps.cz", "9ob88eWJq9ie", "portfolioappscz1");
if ($conn === false) {
	die("ERROR: Could not connect." . mysqli_connect_error());
}

/* Požádání vepsaných dat z formuláře */
$id = $_SESSION['id'];
$full_name_emp = $_SESSION['fname'] . " " . $_SESSION['lname'];
$name_item = $_REQUEST['name_item'];
$quantity_item = $_REQUEST['quantity_item'];
$datum = date("d.m.Y H:i:s");
$success = "";

$_SESSION['phpitem'] = $name_item;
$_SESSION['phpquan'] = $quantity_item;
//SESSIONS
$_SESSION['fullname'] = $full_name_emp;
$_SESSION['date'] = $datum;

/* Vložení dat do SQL */
$sql = "INSERT INTO resources VALUES
        ( null ,'$id', '$full_name_emp', '$name_item', '$quantity_item', '$datum')";

/* CATCH SUCCESFUL/ERROR */
if (mysqli_query($conn, $sql)) {

	$last_id = mysqli_insert_id($conn);
	$_SESSION['lastid'] = $last_id;

	echo "Úspěšně jste vložili položku!" . "<br>";
	echo "Název: " . $name_item . "<br>";
	echo "Počet: " . $quantity_item . "ks";
} else {
	echo "ERROR: Hush sorry $sql."
		 . mysqli_error($conn);
}
mysqli_close($conn);
?>

<script src="assets/js/script.js" type="text/javascript"></script>
