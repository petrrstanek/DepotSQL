<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="bootstrap.min.js">
	<link rel="stylesheet" href="style.css">
	<title>Profile</title>
</head>
<body>
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
	<div class="row pt-5">
		<div class="col-md-6">
			<img src="img/avatar.png" class="img-fluid">
		</div>
		<div class="col-md-6">
			<div class="container-fluid">
				<div class="profile-data">	ID: <?= $_SESSION['id']?></div>
				<div class="profile-data">	Jméno: <?= $_SESSION['fname']?></div>
				<div class="profile-data">	Příjmení: <?=$_SESSION['lname']?></div>
				<div class="profile-data">	Email: <?=$_SESSION['email']?></div>
				<div class="profile-data"> Heslo: <?=$_SESSION['password']?></div>
			</div>
		</div>
		<button class="back" type="button" onclick="location.href='home.php'">Zpět</button>
	</div>
	<h1 class="display-3 text-center pb-5">Vaše provedené záznamy</h1>
</div>

<script src="https://kit.fontawesome.com/09be11f3c3.js" crossorigin="anonymous"></script>
<script>
	<?php require_once("script.js");?>
</script>
</body>
</html>

<?php
session_start();

$conn = mysqli_connect("localhost", "root", "root", "depot");

if(mysqli_connect_errno()){
echo "Failed connect " . mysqli_connect_errno();
}

$record_user = mysqli_query($conn, "SELECT * FROM resources WHERE id={$_SESSION['id']}");
echo"<table>
<th> ID_záznamu</th>
<th> ID_uživatele</th>
<th>Celé jméno</th>
<th>Název Materiálu</th>
<th>Počet</th>
<th>Datum přidání</th>
</tr>";

while($row = mysqli_fetch_array($record_user)){
	echo "<tr>";

	echo "<td>" . $row['id_record'] . "</td>";
	echo "<td>"  . $row['id'] . "</td>";
	echo "<td>" . $row['full_name_emp'] . "</td>";
	echo "<td>" . $row['name_item'] . "</td>";
	echo "<td>" . number_format($row['quantity_item'], '0',',','.' . "ks" . "</td>");
	echo "<td>" . $row['date_added'] . "</td>";
}
echo "</table>"

?>