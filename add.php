<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="style.css">

	<title>Add a Item</title>
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
		Sklad Depot s.r.o
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
$conn = mysqli_connect("localhost", "root", "root", "depot");
if ($conn === false) {
	die("ERROR: Could not connect." . mysqli_connect_error());
}

/* Požádání vepsaných dat z formuláře */
$id = $_SESSION['id'];
$full_name_emp = $_SESSION['fname'] . " " . $_SESSION['lname'];
$name_item = $_REQUEST['name_item'];
$quantity_item = $_REQUEST['quantity_item'];
$datum = date("d-m-Y H:i:s");


//SESSIONS
$_SESSION['fullname'] = $full_name_emp;
$_SESSION['nameitem'] = $name_item;
$_SESSION['quan'] = $quantity_item;
$_SESSION['date'] = $datum;


	/* Vložení dat do SQL */
	$sql = "INSERT INTO resources VALUES
        ( null ,'$id', '$full_name_emp', '$name_item', '$quantity_item', '$datum')";


	/* CATCH SUCCESFUL/ERROR */
	if (mysqli_query($conn, $sql)) {

		$last_id = mysqli_insert_id($conn);
		$_SESSION['lastid'] = $last_id;
		echo "<h1 class='whitening'>
  Úspěšně jste vložili položku:
  </h1>";
	} else {
		echo "ERROR: Hush sorry $sql."
			 . mysqli_error($conn);
	}

mysqli_close($conn);
?>
<div class="container">
	<div class="center-center">
		<div class="row">

			<div class="col-md-12 text-white text-center">
				Jméno: <strong><?=$_SESSION['fullname'];?></strong> </br>
				Položka: <strong><?=$_SESSION['nameitem'];?></strong> </br>
				Počet: <strong><?=$_SESSION['quan'];?></strong> ks</br>
				Datum: <strong><?=$_SESSION['date'];?> </strong></br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button class='trigg' onclick="location.href='home.php'">Dashboard</button>
				<button class='trigg' id="modal-btn">Přidat další položku</button>
				<button class='trigg' onclick="location.href='reset.php'">Vrátit krok</button>
			</div>
		</div>
	</div>
</div>

<script src="https://kit.fontawesome.com/09be11f3c3.js" crossorigin="anonymous"></script>

</body>
</html>
<script type="text/javascript" src="script.js"></script>