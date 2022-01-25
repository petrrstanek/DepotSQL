<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "depot");
/*$conn = mysqli_connect("127.0.0.1", "portfolioapps.cz", "9ob88eWJq9ie", "portfolioappscz1");*/
if($conn === false){
	die("ERROR: Could not connect." . mysqli_connect_error());
}

$summary = mysqli_query($conn, "SELECT name_item, SUM(quantity_item) FROM resources GROUP BY name_item");
echo"
<div class='row'>
<div class='col-md-12 depot-t-style'>
<div class='table-status'>

";

echo "<table id='summary' class='rounded-bottom'>
<tr>
<div class='tab1'><th><small>Dřevo</small><img src='img/wood.png' class='icons'></th></div>
<div class='tab2'><th><small>Hliník</small><img src='img/ore.png' class='icons'></th></div>
<div class='tab3'><th><small>Mramor</small><img src='img/marble.png' class='icons'></th></div>
<div class='tab5'><th><small>Železo</small><img src='img/tubes.png' class='icons'></th></div>
<div class='tab4'><th><small>Olovo</small><img src='img/materials.png' class='icons'></th></div>



</tr>
	";
	while($row = mysqli_fetch_array($summary)){
		echo "<th>" . number_format($row['SUM(quantity_item)'],'0',',','.') . " ks" . "</th>";

	}
echo "</table></div></div></div>";

