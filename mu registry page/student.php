<!--
	- student.php is loaded up when a user logs in as a student
	- this page cannot be accessed by typing the url, therefore, session check is needed.
-->
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
	?>
	<div id="container">
		<!-- add text, pictures, etc. -->
							
		<h2> Description of functions for  student users:</h2>


		<p>My Registration: View the list of registered classes. </p>

		<p>Register Class: Add a class to schedule. </p>
		
		<p>Deregister Class: Remove a class from schedule.</p>
		
		<p>Manage Users: View and/or make changes to system users.</p>
	<img src="includes/hawks.jpg" width="850" height="400" alt="MU photo.">
	</div>
	</body>
	<footer>&copy Monmouth University 2020</footer>
</html>