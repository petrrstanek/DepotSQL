
<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

/* Připojení k databázi */
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

$_SESSION['fullname'] = $full_name_emp;
$_SESSION['nameitem'] = $name_item;
$_SESSION['quan'] = $quantity_item;
$_SESSION['date'] = $datum;

$error_message = "";
//Dotaz pro položky počet ks = 0
$summary = mysqli_query($conn, "SELECT name_item, SUM(quantity_item) FROM resources GROUP BY(name_item)");

/* Plán dat pro SQL */
$sql = "INSERT INTO resources VALUES( null, '$id', '$full_name_emp','$name_item', '$quantity_item', '$datum')";

while ($row = mysqli_fetch_array($summary)) {
	$arraysum = $row['SUM(quantity_item)'];
	$arrayitem = $row['name_item'];

	//Najde položku ve skladě a porovná jestli je jí dostatek pro výdej
	if ($arrayitem === $name_item) {
		$positive_quan = $quantity_item * -1;
		if ($arraysum <= 0 || $positive_quan > $arraysum) {
			echo "Bohužel ve skladu není dostatek položek";
		} else {

		 /* Vložení do databaze */
		 if (mysqli_query($conn, $sql)) {
			 $_SESSION['lastid'] = mysqli_insert_id($conn);
			 echo "Úspěšně jste odebrali položku!" . "</br>";
			 echo "Název: " . $name_item . "</br>";
			 echo "Počet: " . $quantity_item . "ks";
		 } else {
			 echo "ERROR: Hush sorry $sql."
				  . mysqli_error($conn);
		 }
	 }
	}
}
mysqli_close($conn);
?>
<script src="assets/js/script.js" type="text/javascript"></script>