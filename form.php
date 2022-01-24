<!DOCTYPE html>
<html lang="cs_CZ">
<head>
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="style.css">
	<title>PHP</title>
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
<h1>Sklad - Depo</h1>
<h4 class="whitening">Příjem materiálu</h4>
<!--<div class="test"><?/*=$_SESSION['ids']*/?></div>
<div class="test2"><?/*=$_SESSION['num']*/?></div>-->
<div class="form">
	<form action="add.php" method="post">
		Zaměstanec: <br/>
		<input type="text" name="full_name_emp"></br>
		Název Materiálu: <br/>
	<!--	<input type="text" name="name_item"></br>-->
		<select id="material" name="name_item">
			<option value="Dřevo">Dřevo</option>
			<option value="Mramor">Mramor</option>
			<option value="Olovo">Olovo</option>
			<option value="Železo">Železo</option>
			<option value="Hlíník">Hliník</option>
		</select></br>
		Počet Kusů: <br/>
		<input type="text" name="quantity_item"></br>
		Datum Přidání:</br>
    <!--<input type="text" name="date_added"></br>-->
	 	<input type="date" name="date_added" value="2022-15-01" min="2018-15-01" max="2030-15-01"></br>
		<button type="sumbit" value="Vložit" style="width: 100%"> Vložit</button></br>

	</form>
	<button onclick="location.href='home.php'">Zpět</button>

</div>

<script src="https://kit.fontawesome.com/09be11f3c3.js" crossorigin="anonymous"></script>
<script src="script.js"></script>
<?php
include("depot_status.php");

?>
</body>
</html>
