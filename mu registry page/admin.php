<!--
	- admin.php is loaded up when a user logs in as an admin
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
			//user has not logged in. redirect to the login papge
			echo "<script>window.open('login.php', '_SELF')</script>";
			exit();
        }
           		
		include "includes/functions.php";
		navigation();
	?>
	<div id="container">
		<!-- add text, pictures, etc. -->
				
		<h2> Description of functions for  administrators</h2>


		<p>Add Class: Add a new class section to the database. </p>

		<p>Manage Class: Edit an existing class schedule. </p>
		
		<p>Manage Registration: View and/or modify students class registration.</p>
		
		<p>Manage Users: View and/or make changes to system users.</p>
	<img src="includes/garden.jpg" width="850" height="400" alt="mu-garden">
	</div>
	</body>
	
	<footer>&copy Monmouth University 2020</footer>
</html>