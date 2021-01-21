<!DOCTYPE html>
<html>
<head>
	<title>SE357/537</title>
	<link rel="stylesheet" type="text/css" href="includes/myStyle.css">
</head>
<body>
<?php

include "includes/functions.php";
navigation();

echo "<div id='container'>";

$classcode=$_GET['classcode'];
$userid=$_GET['userid'];



$myConn = db_connection_win();


$duplicate = "SELECT * FROM registration WHERE classcode= '$classcode' AND userid= '$userid'";

$d = mysqli_query($myConn,$duplicate);

if ($d) {
	if (mysqli_num_rows($d)>0) {
		echo "<p class = 'err'>You have already registered for this course.</p>";
	}
	else
	{
		$query =  "INSERT INTO registration(userid,classcode) VALUES('$userid','$classcode')";

		$result = mysqli_query($myConn, $query);
		if ($result) 
		{
			echo "<p class = 'err'>Class is registered.</p>";
		}
	}
}

?>
</div>
</body>

	<footer>
		&copy Monmouth University 2020
	</footer>
</html>