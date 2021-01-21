<!DOCTYPE html>
<html>
<head>
	<title>SE357/537</title>
	<link rel="stylesheet" type="text/css" href="includes/myStyle.css">
</head>
<body>
<?php
	session_start();
	if(empty($_SESSION)){
		//$_SESSION is empty, user has not logged in. redirect to the login papge
		echo "<script>window.open('login.php', '_SELF')</script>";
		exit();
    }
	include "includes/functions.php";
	navigation();
	
	echo '<div id="container">';

	$myConn = db_connection_win();
	$userid=$_SESSION['userid'];


	$query = "SELECT * FROM registration WHERE userid = '$userid'";

	$result = mysqli_query($myConn, $query);

	echo "<table id='tbl'>";
	echo "<tr>";
	echo "<th>Class Code</th>";
	echo "<th>Registration Time</th>";
	echo "</tr>";
	
	while($row=mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".$row['classcode']."</td>";
		echo "<td>".$row['date']."</td>";
		echo "</tr>";

	}
	echo "</table>";
	echo "</div>";
?>
</body>


	<footer>
		&copy Monmouth University 2020
	</footer>
</html>

