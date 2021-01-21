<!-- 
	login.php
	points to learn:
	1. overall login logic: 
	   a. fill the form
	   b. retrieve the form data (userid and password)
	   c. connect to database
	   d. search for the user, if not found, error message
	   e. check if password is correct, if not, error message
	   f. set session variables
	   g. jump to the related page
	2. session control
	   a. when a user logs in, a session begins; when the user logs out, the session ends
	   b. session vaiables are used for session control
	   c. in this project, session variables are userid and role
	   d. session variables are stored in array $_SESSION
	   e. example of setting a session variable: $_SESSION['userid']=$userid;
	   f. for all pages that can only be access by users who are logged in, we need
	      to check session variables first
-->

<html>
<head>
	<title>SE357/517</title>
	<link rel = "stylesheet" type = "text/css" href = "includes/myStyle.css" />
</head>

<body>
	<?php
		//before user log in, make sure no session is on
		session_start();
		$_SESSION = array();    //clean up session variables
		session_destroy();    //distroy possible existing session
	
		//clean up cookies
		setcookie('userid');
		setcookie('role');
		setcookie('fname');
				
		include "includes/functions.php";   //all functiona
		navigation();
		
	echo '<div id="container">';
			
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			//retrieve form data
			$userid = $_POST['userid'];
			$psword = $_POST['psword'];
			//$psword = SHA1($psword);
			//connect to database
			$myConn = db_connection_win();
			
			//define a query to select the record for the userid				
			$q = "SELECT * FROM users WHERE userid = '$userid'";
				
			//execute the query, return data is referenced by $r
			$r = mysqli_query($myConn, $q);
					
			//find the record, cannot be more than one because userid is the primary key
			if (mysqli_num_rows($r) == 1){
				//save the record to an array $row
				$row = mysqli_fetch_array($r);

				//check if the password input ($psword) matches the one stored in the table ($row['password'])
				if ($psword == $row[1] && $row['blocked'] == 0){
					session_start();
								
					//set session variables
					$_SESSION['userid'] = $userid;
					$_SESSION['role'] = $row['role'];
					$_SESSION['fname'] = $row['fname'];
					
					//set cookies, will expire in 10 seconds
					//if you want them to expire in one hour, then just replace 10 with 3600
					$cookie_duration = 10000;
					setcookie('userid', $userid, time()+$cookie_duration);
					setcookie('role', $row['role'], time()+$cookie_duration);
					setcookie('fname', $row['fname'], time()+$cookie_duration);
								
					//check the role of user
					if($row['role'] == 'student'){
						//studen, jump to student.php
						echo "<script>window.open('student.php', '_SELF')</script>";
						exit();
					}
					else {
						//not a student, jump to admin.php
						echo "<script>window.open('admin.php', '_SELF')</script>";
						exit();
					}
				}
				else if($psword == $row[1] && $row['blocked'] == 1){
					echo "<p class='err'>You are blocked.</p>";	
				}
				else {
					echo "<p class='err'>Incorrect password.</p>";
				}
			}
			else
				echo "<p class='err'>User ID not found.</p>";	 
		}
	?>	
		
	<form acton="" method="POST">
			<input type="text" name="userid" value="<?php echo $_POST['userid'] ?>" placeholder="Enter your userid..." required>
			<input type="password" name="psword" placeholder="Enter your password..." required>
			<input type="submit" name="submit" value="Log in" >	

			<br><br>
		   	<p> Forgot your password? <a href = reset_psword.php>Click here to reset your password.</a> </p>
			
			<p> Not a user yet? <a href = sign_up.php>Click here to sign up.</p>
	</form>
		
	</div>   <!-- container -->

	<footer> &copy Monmouth University 2020 </footer>
<body>
</html>



