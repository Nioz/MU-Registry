
<html>
	<head>
		<title>SE357/517 DeRegister class</title>
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
		else {
		    //retrieve userid and role from cookies.
    		//note: we also stored them in $_session[] and they are retrieved in menu.php,
    		//therefore, the following two assignment statements are not neccessary.
			$userid = $_COOKIE['userid'];
			$role = $_COOKIE['role'];
		}
		

		include "includes/functions.php";
		navigation();
		
		echo '<div id="container">';
			
		//Connecting the data base
		$myConn=db_connection_win();
			
		//define the select (read) query
		//note that we only select records associated with this user
		$q="SELECT * FROM registration WHERE userid ='$userid'";
			
		//execute the query
		$r=mysqli_query($myConn,$q);
			
		//Display classes table records			
		if(mysqli_num_rows($r)>0){
            $tb = array("Class Code", "Registration Time", "Action");
                    
            echo "<table id='tbl'>";
			display_table($tb, "th");
			
			
			while($row=mysqli_fetch_assoc($r)){
			    $tb = array($row['classcode'], $row['date'], "<a onClick=\"javascript: return confirm('Do you really want to deregister this course?');
					\"href='do_deregistration.php?regid=".$row['regid']."'>Deregister</a>");
				display_table($tb, "td");

			}
			echo "</table>";
		}
				
	?>
	</div>
	</body>
<footer>&copy Monmouth University 2020</footer>
</html>		
