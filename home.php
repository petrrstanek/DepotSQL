<!DOCTYPE html>
<html lang="cs-CZ">
<head>
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="bootstrap.css">
	<title>DASHBOARD</title>
</head>
<body onload="updateTime()">
<!-- SESSION PRO LOGIN -->
<?php
session_start();
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$email = $_SESSION['email'];
?>

<!-- NAVBAR -->
<header id="nav">
	<nav class="navbar navbar-expand-sm navbar-light bg-light">
		<div class="container">
			<a href="home.php" class="navbar-brand">depotGistics</a>
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

<!-- Widget stav skladu -->
<div class="container">
	<?php
	include('depot_status.php');
	?>
</div>
<div class="container text-center pt-4">
	<h1>Evidence skladových zásob</h1>
</div>

<!-- FORM ADD -->
<div id="form-modal" class="modal">
	<div class="modal-content">
		<div class="form">
			<div class="form-header">
				<h4 class="whitening">Příjem materiálu</h4>
				<span class="close">&times</span>
			</div>
			<form action="add.php" method="POST" id="form-add">
				<div class="alert alert-success">
					<span id="message-box"></span>
				</div>
				Zaměstanec: <br/>
				<input type="text" class="form-data" id="email" value="<?= $_SESSION['fname'] . " " . $_SESSION['lname'] ?>"
							 name="full_name_emp"></br>
				Název Materiálu: <br/>
				<select id="material" name="name_item" class="form-data text-white">
					<option value="" selected="selected"> --- Vyberte Materiál ---</option>
					<option value="Dřevo" name="wood">Dřevo</option>
					<option value="Mramor" name="marble">Mramor</option>
					<option value="Olovo">Olovo</option>
					<option value="Železo">Železo</option>
					<option value="Hliník">Hliník</option>
				</select></br>
				Počet Kusů: <br/>
				<input type="number" min="0" name="quantity_item" class="num form-data text-white"></br>
				Datum Přidání:</br>
				<!--<input type="text" name="date_added"></br>-->
				<input type="text" name="date_added" value="" id="date" class="form-data"></br>
				<button type="sumbit" value="Vložit" id="button-add" style="width: 100%"> Vložit</button>
				</br>
				<span class="time-form">A</span>
			</form>
			<!--<button onclick="location.href='home.php'">Zpět</button>-->
		</div>
	</div>
</div>

<!-- FORM REMOVE -->
<div id="form-modal-remove" class="modal">
	<div class="modal-content-remove">
		<div class="form-remove">
			<div class="form-header-remove">
				<h4 class="whitening">Výdej materiálu</h4>
				<span class="close-remove">&times</span>
			</div>
			<form action="remove.php" method="post">
				Zaměstanec: <br/>
				<input type="text" id="email-remove" value="<?= $_SESSION['fname'] . " " . $_SESSION['lname'] ?>"
							 name="full_name_emp"></br>
				Název Materiálu: <br/>
				<!--<input type="text" name="name_item" id="quan"></br>-->
				<select id="material" name="name_item">
					<option value="Dřevo">Dřevo</option>
					<option value="Mramor">Mramor</option>
					<option value="Olovo">Olovo</option>
					<option value="Železo">Železo</option>
					<option value="Hliník">Hliník</option>
				</select></br>
				Počet Kusů: <br/>
				<input type="number" max="0" name="quantity_item" id="quan" placeholder="Zadej mínusovou hodnotu"></br>
				Datum Odebrání:</br>
				<input type="text" name="date_added" value="" id="date-remove"></br>
				<button type="sumbit" value="Vložit" id="remove" style="width:100%"> Odebrat</button>
				</br>
			</form>
		</div>
	</div>
</div>
<script src="https://kit.fontawesome.com/09be11f3c3.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
				integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
				crossorigin="anonymous"></script>
</body>
</html>

<!-- EVIDENCE -->
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "depot");
/*$conn = mysqli_connect("127.0.0.1", "portfolioapps.cz", "9ob88eWJq9ie", "portfolioappscz1");*/
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL:" . mysqli_connect_error();
}
$result = mysqli_query($conn, "SELECT * FROM resources");
echo $_SESSION['username'];
echo "
<div class='container'>
<div class='row pt-5'>
	<div class='col-md-9 ev-style'>
		<div class='table-ev'>
			<table class='record-t-style'>
			<thead>
			<tr class='thead'>
				<th>ID_Záz</th>
				<th>ID_Uži</th>
				<th>Jméno</th>
				<th></i>Materiál</th>
				<th></i>Počet</th>
				<th></i>Datum</th>
				</tr>
			</thead>
				";
while ($row = mysqli_fetch_array($result)) {
	$_SESSION['rowid'] = $row['id_record'];
	$_SESSION['fullname'] = $row['full_name_emp'];
	echo "<tr>";
	echo "<td>" . $row['id_record'] . "</td>";
	echo "<td>" . "ID: " . $row['id'] . "</td>";
	echo "<td>" . $row['full_name_emp'] . "</td>";
	echo "<td>" . $row['name_item'] . "</td>";
	echo "<td>" . number_format($row['quantity_item'], '0', ',', '.') . " ks" . "</td>";
	echo "<td>" . $row['date_added'] . "</td>";
	echo "</tr>";
}
echo "</table></div></div>";
echo "
<div class='col-md-3'>
	<button id='modal-btn' class='trigg'>Přidat Položku</button>
	<button id='modal-btn-remove' class='trigg mt-5'>Odebrat Položku</button>
";
echo "</div></div></div>";
echo "
<div class='container text-center pt-4'>
	<span class='cur-time'></span>
</div>
";
mysqli_close($conn)
?>
<script type="text/javascript" src="script.js"></script>




