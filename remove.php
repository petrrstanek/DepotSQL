<!DOCTYPE html>
<html lang="cs-CZ">
<head>
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="style.css">
	<title>Remove a Item</title>
</head>
<body>
<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<header id="nav">
	<div class="brand">
		<a href="home.php">Skladová firma s.r.o</a>
	</div>

	<nav class="navbar">

		<div class="nav-container">


			<div class="member">
				<a href="profile.php"><?= $_SESSION['name'] ?></a>

			</div>
			<div class="log"><a href="index.html"><i class="fas fa-sign-out-alt" style="font-size: 35px;"></i> Log Out</a>
			</div>
		</div>


	</nav>
</header>

<?php
session_start();
/* Připojení k databázi */
$conn = mysqli_connect("localhost", "root", "root", "depot");
if ($conn === false) {
	die("ERROR: Could not connect." . mysqli_connect_error());
}

/* Požádání vepsaných dat z formuláře */
$id = $_SESSION['id'];
$full_name_emp = $_SESSION['fname'] . " " . $_SESSION['lname'];
$name_item = $_REQUEST['name_item'];
$quantity_item = $_REQUEST['quantity_item'];
$datum = date("Y-m-d H:i:s");

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
		if ($arraysum <= 0) {
			echo "<h1 class='whitening pad'>Bohužel ve skladu není dostatek položek</h1>";
		} else {

		 /* Vložení do databaze */
		 if (mysqli_query($conn, $sql)) {
			 $_SESSION['lastid'] = mysqli_insert_id($conn);
			 echo "<h1 class='whitening'>
  Úspěšně jste odebrali položku:
  </h1>";
//RECAP
			 echo nl2br("\n 
	<div class='container pad text-center'>
  <p class='whitening'>Vaše jméno: $full_name_emp</p> \n 
  <p class='whitening'>Odebraný materiál: $name_item</p> \n"
				  . "<p class='whitening'>Počet: $quantity_item</p> \n 
    <p class='whitening'>Kdy: $datum</p></div> \n");
		 } else {
			 echo "ERROR: Hush sorry $sql."
				  . mysqli_error($conn);
		 }
	 }
	}
}

mysqli_close($conn);
?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			Jméno: <?=$_SESSION['fullname'];?> </br>
			Položka: <?=$_SESSION['nameitem'];?></br>
			Počet: <?=$_SESSION['quan'];?></br>
			Datum: <?=$_SESSION['date'];?></br>
		</div>
		<div class="col-md-6 d-flex flex-column">
			<button onclick="location.href='home.php'">DASHBOARD</button>
			<button onclick="location.href='form.php'">Odebrat další položku</button>
			<button onclick="location.href='reset.php'">Reset</button>
		</div>
	</div>
</div>


<script src="https://kit.fontawesome.com/09be11f3c3.js" crossorigin="anonymous"></script>
</body>
</html>
