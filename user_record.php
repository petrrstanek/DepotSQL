<?php
session_start();

/*$conn = mysqli_connect("localhost", "root", "root", "depot");*/
$conn = mysqli_connect("127.0.0.1", "portfolioapps.cz", "9ob88eWJq9ie", "portfolioappscz1");
if(mysqli_connect_errno()){
echo "Failed connect " . mysqli_connect_errno();
}

$record_user = mysqli_query($conn, "SELECT * FROM resources WHERE id={$_SESSION['id']}");
echo"<div class='container'><div class='profile-t'><table class='profile-t-style'>
			<tr style='position:sticky; top: 0; background-color: #5794cc;'>
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
				echo "</table></div></div>";
