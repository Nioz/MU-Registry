<!-- 
	- this is the home page of the website
	- it is invoked either by typing the url, or user log out
	- you can add anything you want in the <div id="container"> division
-->

<html>
	<head>
		<title>SE357/537</title>
		<link rel="stylesheet" type="text/css" href="includes/myStyle.css">
	</head>
	<body>
	<?php 
		session_start();   //for session operation
		$_SESSION=array();    //clean up session variables
		
		//clean up cookies
		setcookie('userid');
		setcookie('role');
		setcookie('fname');
		
		include "includes/functions.php";   //all functiona
		navigation();
	?>
	<div id="container">
		<!-- add text, pictures, etc. -->
		
		<h2> Welcome to MU Registration System! </h2>


		<p>As the official “Records Office” at Monmouth University, the Office of the Registrar 
	has an important mission which supports the operation of the University.  This is the 
	office of the University authorized to issue official transcripts, certify the 
	enrollment and attendance of students, and determine eligibility for graduation.  
	Accordingly, the Registrar and the staff of the Office of the Registrar have the 
	responsibility of maintaining timely and accurate student academic records, while 
	maintaining the privacy and security of those records. </p>

		<p>As a central administrative office of the University, the Office of the Registrar 
	is responsible for scheduling classes into the general classroom spaces, registering 
	students for classes, grade recording, and grade reporting.  This Office provides 
	data for internal and external reporting, assists schools and departments by furnishing 
	needed data and other services, assists the faculty wherever possible, and renders 
	services to alumni by providing transcripts, certifications, and other records as 
	needed.</p>
	<img src="includes/inquirySmDt.jpg" width="850" height="400" alt="MU photo.">
	
	</div>
	</body>

	<footer>
		&copy Monmouth University 2020
	</footer>
</html>