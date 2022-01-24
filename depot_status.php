<?php
session_start();
$conn = mysqli_connect("localhost","root","root","depot");
if($conn === false){
	die("ERROR: Could not connect." . mysqli_connect_error());
}

$summary = mysqli_query($conn, "SELECT name_item, SUM(quantity_item) FROM resources GROUP BY name_item");
echo"
<div class='row'>
<div class='col-md-12 status-t-style'>
<div class='table-status'>


";

echo "<table id='summary' class='rounded-bottom'>
<tr>
<div class='tab1'><th><img src='img/wood.png' class='icons'></th></div>
<div class='tab2'><th><img src='img/marble.png' class='icons'></th></div>
<div class='tab3'><th><img src='img/materials.png' class='icons'></th></div>
<div class='tab4'><th><img src='img/tubes.png' class='icons'></th></div>
<div class='tab5'><th><img src='img/ore.png' class='icons'></th></div>

</tr>
	";
	while($row = mysqli_fetch_array($summary)){
		echo "<th>" . number_format($row['SUM(quantity_item)'],'0',',','.') . " ks" . "</th>";

	}
echo "</table></div></div></div>";

