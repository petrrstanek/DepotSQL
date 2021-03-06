<?php
session_start();
/*$db_host = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'signup';*/

$db_host = "127.0.0.1";
$db_username = "portfolioapps.cz";
$db_password = "9ob88eWJq9ie";
$db_name = "portfolioappscz2";

$con = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if(mysqli_connect_errno()){
	die('Failed to connect to MySQL:' . mysqli_connect_error());
}

$error_message = "";
$success_message = "";

//Register
if(isset($_POST['btnsignup'])){
	$fname = trim($_POST['fname']);
	$lname = trim($_POST['lname']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$confirmpassword = trim($_POST['confirmpassword']);

	$isValid = true;
	$filter = "depotgistics";
	$compare = strpos($email, $filter);


	//Check empty space
	if($fname == '' || $lname == ' || $email == '|| $password == '' || $confirmpassword == ''){
		$isValid = true;
		$error_message = "Vyplňte prosím všechna pole";
	}

	//Pass Check
	if($isValid && ($password != $confirmpassword)){
		$isValid = true;
		$error_message = "Hesla se neshodují";
	}

	if($compare == false){
		$isValid = false;
		$error_message = "Emailová adresa musí obsahovat @depotgistics.cz";
	}

	//Email Check
	 if($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)){
		 $isValid = false;
		 $error_message = "Emailová adresa byla zadána špatně";
	 }

	 if($isValid){
		 $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
		 $stmt->bind_param("s", $email);
		 $stmt-> execute();
		 $result = $stmt->get_result();
		 if($result->num_rows>0){
			 $isValid = false;
			 $error_message = "Email je už zaregistrován.";
		 }
	 }

	 if($isValid){
		 $insertSQL = "INSERT INTO users(fname,lname,email,password) values(?,?,?,?)";
		 $stmt = $con->prepare($insertSQL);
		 $stmt->bind_param("ssss",$fname,$lname,$email,$password);
		 $stmt->execute();
		 $stmt->close();
		 $success_message = "Registrace proběhla úspěšně";
		 header("Refresh:5; url=https://www.portfolioapps.cz/index.html", true, 303);
	 }
}
?>

<!doctype html>
<html lang="cs-CZ">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/js/bootstrap.min.js">
	<link rel="stylesheet" href="assets/css/style.css">
	<title>Register</title>
</head>
<body>

<h1>Registruj se v depotGistics</h1>
<div class="form">
	<form method="post" action="">

		<?php if(!empty($error_message)){ ?>

			<div class="alert alert-danger">
			<strong>Error! </strong><?=$error_message?>
		</div>

		<?php } ?>

		<?php if(!empty($success_message)){ ?>

		<div class="alert alert-success">
			<strong><?=$success_message?></strong>
		</div>

			 <?php } ?>

		<label for="fname"> Jméno:</label>
		<input type="text" class="form-control" id="fname" name="fname" required="required" maxlength="80">

		<label for="fname"> Příjmení:</label>
		<input type="text" class="form-control" id="lname" name="lname" required="required" maxlength="80">

		<label for="fname"> Email:</label>
		<input type="text" class="form-control" id="email" name="email" required="required" maxlength="80" placeholder="priklad@depotgistics.cz">

		<label for="fname"> Heslo:</label>
		<input type="password" class="form-control" id="password" name="password" required="required" maxlength="80">

		<label for="fname"> Potvrdit Heslo:</label>
		<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" onkeyup="" required="required" maxlength="80">

		<button type="submit" name="btnsignup" class="pt-2 w-100">Registrovat</button>
		<br>
		<a href="index.html">
			<small class="text-white">Už máte účet? Přihlaste se zde!</small>
		</a>


	</form>
</div>

<script src="https://kit.fontawesome.com/09be11f3c3.js" crossorigin="anonymous"></script>
</body>
</html>