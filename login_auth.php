<?php
include('conn.php');
session_start();
$db_host = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "signup";

/*$db_host = "127.0.0.1";
$db_username = "portfolioapps.cz";
$db_password = "9ob88eWJq9ie";
$db_name = "portfolioappscz2";*/

$con = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if (mysqli_connect_errno()) {
	exit("Failed to connect with MySQL:" . mysqli_connect_error());
}

if (!isset($_POST['email'], $_POST['password'])) {
	exit('ERROR');
}

//FETCH a porovnání hesla k příhlášení
if ($stmt = $con->prepare('SELECT id, fname, lname, password FROM users WHERE email = ?')) {
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id,$fname, $lname, $password );
		$stmt->fetch();
		if (trim($_POST['password']) === $password) {
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['id'] = $id;
			$_SESSION['lname'] = $lname;
			$_SESSION['fname'] = $fname;
			header('Location: home.php');
		} else { /*PASSWORD*/
			echo 'Incorrect username or password!';
		}
	} else { /*USERNAME*/
		echo 'Incorrect username or passrd!';
	}
	$stmt->close();
}