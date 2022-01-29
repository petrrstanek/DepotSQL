
<?php
session_start();
/*$conn = mysqli_connect("localhost", "root", "root", "depot");*/
$conn = mysqli_connect("127.0.0.1", "portfolioapps.cz", "9ob88eWJq9ie", "portfolioappscz1");
if($conn === false){
	die("ERROR: Could not connect." . mysqli_connect_error());
}

$inventoryNames = mysqli_query($conn,"SELECT name_item FROM resources WHERE id={$_SESSION['id']} GROUP BY name_item");
$inventorySums = mysqli_query($conn, "SELECT name_item, SUM(quantity_item) FROM resources WHERE id={$_SESSION['id']} GROUP BY name_item");

echo "
<div class='row'>
<div class='col-md-12 status-t-style'>
<div class='table-status'>
";

echo "<table id='summary' class='rounded-bottom'>";
echo "<tr>";
while($rowNames = mysqli_fetch_array($inventoryNames)){
$arrayname = $rowNames['name_item'];
$arraysum = $rowNames['SUM(quantity_item'];
if(count($rowNames) == 0){
	echo "<th>" . "V inventáři nejsou žádné položky" . "</th>";
}
echo "<th>" . $arrayname . "</th>";
}
echo "</tr>";
echo "<tr>";
while ($rowSums = mysqli_fetch_array($inventorySums)){
	$arraysum = $rowSums['SUM(quantity_item)'];
	echo "<th>" . $arraysum . "ks" . "</th>";
}
echo "</tr>";
echo "</table></div></div></div>";
?>
<script type="text/javascript" src="assets/js/script.js"></script>