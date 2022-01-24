

<!DOCTYPE html>
<html lang="cs-CZ">
<head>
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="style.css">

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
			<a href="home.php" class="navbar-brand">Sklad Depot s.r.o</a>
			<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
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

<div class="container text-center pad">
	<h1>Evidence skladových zásob</h1>


</div>
<!--<button id='modal-btn-remove' class='trigg'>Odebrat Položku</button>
<button id='modal-btn' class='trigg'>Přidat Položku</button>-->

<!-- FORM ADD -->    <!--<div class="test"><? /*=$_SESSION['ids']*/ ?></div>
<div class="test2"><? /*=$_SESSION['num']*/ ?></div>-->

<div id="form-modal" class="modal">
	<div class="modal-content">
		<div class="form">
			<div class="form-header">
				<h4 class="whitening">Příjem materiálu</h4>
				<span class="close">&times</span>
			</div>
			<?php if(!empty($success_message)){?>
				<div class="alert alert-success">
					<strong><?=$success_message?>
					</strong></br>
					<hr>

				</div>
			<?php }?>

			<form action="add.php" method="post">
				Zaměstanec: <br/>
				<input type="text" id="email" value="<?= $_SESSION['fname'] . " " . $_SESSION['lname'] ?>"
							 name="full_name_emp"></br>
				Název Materiálu: <br/>
				<!--	<input type="text" name="name_item"></br>-->
				<select id="material" name="name_item">
					<option value="Dřevo">Dřevo</option>
					<option value="Mramor">Mramor</option>
					<option value="Olovo">Olovo</option>
					<option value="Železo">Železo</option>
					<option value="Hliník">Hliník</option>
				</select></br>
				Počet Kusů: <br/>
				<input type="number" min="0" name="quantity_item" class="num"></br>
				Datum Přidání:</br>
				<!--<input type="text" name="date_added"></br>-->
				<input type="text" name="date_added" value="" id="date"></br>
				<button type="sumbit" value="Vložit" style="width: 100%"> Vložit</button>
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
					<option value="Hlíník">Hliník</option>
				</select></br>
				Počet Kusů: <br/>
				<input type="number" max="0" name="quantity_item" id="quan" placeholder="Zadej mínusovou hodnotu"></br>
				Datum Odebrání:</br>

				<input type="text" name="date_added" value="" id="date-remove"></br>
				<button type="sumbit" value="Vložit" id="remove" style="width:100%"> Odebrat</button>
				</br>
				<span class="cur time"></span>
			</form>
		</div>
	</div>
</div>


<script src="https://kit.fontawesome.com/09be11f3c3.js" crossorigin="anonymous"></script>


</body>
</html>


<!-- EVIDENCE -->
<?php

session_start();
$conn = mysqli_connect("localhost", "root", "root", "depot");

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
				<tr style='position: sticky; top: 0; background-color: rgb(87, 148, 204); border-bottom: 2px solid white;'>
				<th>ID_Záz</th>
				<th>ID_Uži</th>
				<th>Jméno</th>
				<th></i>Materiál</th>
				<th></i>Počet</th>
				<th></i>Datum</th>
				</tr>";

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
		<button id='modal-btn-remove' class='trigg'>Odebrat Položku</button>
<button id='modal-btn' class='trigg'>Přidat Položku</button>
			
";
echo "</div></div></div>";

/*STAV SKLADU*/
include("depot_status.php");
echo "
<div class='container text-center pt-4'>
<span class='cur-time'></span>
</div>

";
mysqli_close($conn)
?>
<script type="text/javascript" src="script.js"></script>




