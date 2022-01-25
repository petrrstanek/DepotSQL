<!DOCTYPE html>
<html lang="cs-CZ">
<head>
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	<nav class="navbar navbar-expand-sm navbar-light bg-light">
		<div class="container">
			<a href="home.php" class="navbar-brand">Sklad Depot s.r.o</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a href="profile.php" class="nav-link">
							<i class="fas fa-user" style="font-size: 35px;"></i>
					<?= $_SESSION['email']; ?>
						</a>
					</li>
					<li class="nav-item">
						<a href="index.html" class="nav-link logout">
							<i class="fas fa-sign-out-alt" style="font-size: 35px;"></i>
							Odhlásit
						</a>
					</li>

				</ul>
			</div>
		</div>
	</nav>
</header>

<?php
session_start();
/* Připojení k databázi */
$conn = mysqli_connect("localhost", "root", "root", "depot");
/*$conn = mysqli_connect("127.0.0.1", "portfolioapps.cz", "9ob88eWJq9ie", "portfolioappscz1");*/
if ($conn === false) {
	die("ERROR: Could not connect." . mysqli_connect_error());
}

/* Požádání vepsaných dat z formuláře */
$id = $_SESSION['id'];
$full_name_emp = $_SESSION['fname'] . " " . $_SESSION['lname'];
$name_item = $_REQUEST['name_item'];
$quantity_item = $_REQUEST['quantity_item'];
$datum = date("d-m-Y H:i:s");

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
			echo "<h1 class='whitening pad'>Bohužel ve skladu není dostatek položek</h1>";
			echo "
<div class='btn-neg-val'>
<a href='home.php' style='padding-right: 50px'>
<button class='trigg'>Dashboard</button>
</a>
<a href='#'><button class='trigg'>Odebrat znovu</button>
</a>
</div>

";
		} else {

		 /* Vložení do databaze */
		 if (mysqli_query($conn, $sql)) {
			 $_SESSION['lastid'] = mysqli_insert_id($conn);
			 echo "<h1 class='whitening'>
  Úspěšně jste odebrali položku:
  </h1>";
//RECAP
			 echo "
<div class='container'>
	<div class='center-center'>
		<div class='row'>
			<div class='col-md-12 text-white text-center'>
				Vaše jméno: $full_name_emp</br>
 				Odebraný materiál: $name_item</br>
				Počet: $quantity_item</br>
  		  Kdy: $datum
			</div>
		</div>
		<div class='row'>
			<div class='col-md-12'>
				<a href='home.php'>
   			 	<button class='trigg'>Dashboard</button>
				</a>
				<a href='#'>
					<button class='trigg'>Odebrat další položku</button>
				</a>
				<a href='reset.php'>
					<button class='trigg'>Vrátit krok</button>
				</a>
			</div>
		</div>
	</div>
</div>
";
		 } else {
			 echo "ERROR: Hush sorry $sql."
				  . mysqli_error($conn);
		 }
	 }
	}
}

mysqli_close($conn);
?>
<!--
<div class="container">
	<div class="row">
		<div class="col-md-12 text-white text-center">
			Jméno: <?/*=$_SESSION['fullname'];*/?> </br>
			Položka: <?/*=$_SESSION['nameitem'];*/?></br>
			Počet: <?/*=$_SESSION['quan'];*/?></br>
			Datum: <?/*=$_SESSION['date'];*/?></br>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<button class='trigg' onclick="location.href='home.php'">DASHBOARD</button>
			<button class='trigg' onclick="location.href='form.php'">Odebrat další položku</button>
			<button class='trigg' onclick="location.href='reset.php'">Reset</button>
		</div>
	</div>
</div>
-->

<script src="https://kit.fontawesome.com/09be11f3c3.js" crossorigin="anonymous"></script>
</body>
</html>
