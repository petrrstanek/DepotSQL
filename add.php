<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

session_start();
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
$datum = date("d.m.Y H:i:s");
$success = "";


//SESSIONS
$_SESSION['fullname'] = $full_name_emp;
$_SESSION['nameitem'] = $name_item;
$_SESSION['quan'] = $quantity_item;
$_SESSION['date'] = $datum;
?>
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
					<?= $_SESSION['email'];?>
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


<?php
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
