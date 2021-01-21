 <html>
	<head>
		<title>SE357/517 Do DeRegistration</title>
		<link rel="stylesheet" type="text/css" href="includes/myStyle.css">
	</head>
	<body>
	<?php 
		session_start();
		//Check Session
		/*if(empty($_SESSION)){
			//$_SESSION is empty, user has not logged in. redirect to the login papge
			echo "<script>window.open('login.php', '_SELF')</script>";
			exit();
		}*/
			
		//Check cookies
		if(!isset($_COOKIE['userid']) || $_COOKIE['role'] != 'student'){
			echo "<script>window.open('login.php', '_SELF')</script>";
			exit();
		}
			    

		include "includes/functions.php";   //all functions
		navigation();
			
		echo '<div id="container">';
			
		//process form data
		//Delete them from database and then display the data in the deregistration table
		if ($_SERVER['REQUEST_METHOD'] =='GET'){
			//retrieve regid from $_GET[]
			$regid=$_GET['regid'];
			
			//connect to the server
			$myConn=db_connection_win();
					
			//define the DELETE query
			$q="DELETE FROM registration WHERE regid='$regid'";
		
			//execute the query
			$r=mysqli_query($myConn, $q);
					
			//deregistered message.
			echo '<p class="err">Data deleted successfully</p>';
					
		}
		else {
			//the Deleting action is failed
			echo "Data deletion is failed.";
		}	
	?>

		</div>
	</body>
	<footer>&copy Monmouth University 2020</footer>
</html>