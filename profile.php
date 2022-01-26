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
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="style.css">
	<title>Profile</title>
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

<div class="transform-body">
	<div class="container d-flex justify-content-center pt-5">
		<button class='roll' onclick='roll()'>
			<h1 class="display-4">Můj Profil</h1>
			<i class='fas fa-angle-double-down' style="font-size: 70px; color: white; margin-left: 30px; margin-bottom: 7px"></i>
						<!--<div class="container-arrow">
							<div class="arrow"></div>
						</div>-->
		</button>
	</div>
	<div class="container">
		<div class="row pt-1">
			<div class="col-md-6 justify-content-center d-flex align-items-center">
				<img src="img/user.png" class="img-fluid" style="width: 290px;">
			</div>
			<div class="col-md-6">
				<div class="container-fluid text-center text-md-start">
					<div class="profile-data">	ID: <?= $_SESSION['id']?></div>
					<div class="profile-data">	Jméno: <?= $_SESSION['fname']?></div>
					<div class="profile-data">	Příjmení: <?=$_SESSION['lname']?></div>
					<div class="profile-data">	Email: <?=$_SESSION['email']?></div>
					<div class="profile-data"> Heslo: <?=$_SESSION['password']?></div>
				</div>
			</div>
			<div class="profile-buttons text-center pt-4 d-flex justify-content-center">
				<button class='trigg'onclick="location.href='attendance.php'">Docházka</button>
				<button class="trigg mx-5" onclick="location.href='user_record.php'">Moje záznamy</button>
				<button class="trigg" type="button" onclick="location.href='home.php'">Zpět</button>
			</div>
		</div>
	</div>
</div>

<script src="https://kit.fontawesome.com/09be11f3c3.js" crossorigin="anonymous"></script>
<script>
	<?php require_once("script.js");?>
</script>
<script src="bootstrap.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>

<?php
session_start();
include("inventory.php");
?>

