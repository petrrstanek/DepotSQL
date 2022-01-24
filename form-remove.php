<!DOCTYPE html>
<html lang="cs-CZ">
<head>
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="style.css">
	<title>PHP</title>
</head>
<body>
<?php
session_start();

if(!isset($_SESSION['loggedin'])){
	header('Location: index.html');
	exit;
}
?>
<header id="nav">
	<nav class="navbar">
		<div class="nav-container">
			
			<div class="member">
				<a href="profile.php"><?=$_SESSION['name']?></a>
				<a href="index.html">Log Out</a>
			</div>
		</div>


	</nav>
</header>
<h1>Sklad - Depo</h1>
<h4 class="whitening">Výdej materiálu</h4>

<div class="form">
	<form action="remove.php" method="post">
		Zaměstanec: <br/>
		<input type="text" name="full_name_emp"></br>
		Název Materiálu: <br/>
		<!--<input type="text" name="name_item" id="quan"></br>-->
		<select id="material" name="name_item">
			<option value="Dřevo">Dřevo</option>
			<option value="Mramor">Mramor</option>
			<option value="Olovo">Olovo</option>
			<option value="Železo">Železo</option>
			<option value="Hlíník">Hliník</option>
		</select></br>
		Počet Kusů: <br/>
		<input type="number" max="0" name="quantity_item" id="quan" placeholder="Zadej mínusovou hodnotu"></br>
		Datum Odebrání:</br>

	 	<input type="date" name="date_added" value="2022-15-01" min="2018-15-01" max="2030-15-01"></br>
		<button type="sumbit" value="Vložit" id="remove" style="width:100%"> Odebrat</button></br>

	</form>
	<button onclick="location.href='home.php'" style="width: 100%">Zpět</button>
	<script>
      if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
      }
	</script>
	<script src="https://kit.fontawesome.com/09be11f3c3.js" crossorigin="anonymous"></script>
</div>

<?php
include("depot_status.php");

?>
</body>
</html>