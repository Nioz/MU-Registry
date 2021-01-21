<!--
Steps:
1. user inputs username.
2. system finds email address according to user's uname.
3. system creates a random psword and hash it.
4. system updates new psword into user's profile.
5. system sends the new psword and a link to index page to the user's email account.

Note: the function reandomString() is added to functions.php.
-->


<html>
<head>
	<title>SE357/537</title>
	<link rel="stylesheet" type="text/css" href="includes/myStyle.css">
</head>

<body>
	<?php
		include "includes/functions.php";
		navigation();
	?>

  <div id = "container">
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST')  {	
			if (isset($_POST['back'])) {
				echo "<script>window.open('login.php', '_SELF')</script>";
				exit();
			}
			
			if(isset($_POST['reset'])) { 

				$myConn = db_connection_win();
				
				$userid = $_POST['userid'];
				
				$q = "SELECT * FROM users WHERE userid = '$userid'";
				
				$r = mysqli_query($myConn, $q);

				
				if (mysqli_num_rows($r) == 1) {
					$row = mysqli_fetch_array($r);
					$email = $row['email'];
					$fname = $row['fname'];
					
					//get temp password with a length of 8 characters
					$length = 8;
					$temp_psword = randomString($length);
					
					//hashing the temp password
					$temp_psword_hashed = SHA1($temp_psword);
					
	     			//change password to the new one
					$update = "UPDATE users SET password = '$temp_psword_hashed' WHERE userid = '$userid'";
					$u = mysqli_query($myConn, $update);
					if (!$u)
						echo "Something Wrong";
					else {		//send the new password to user's email account
						$to = $email;
						$subject = 'New Password for Monmouth Online Registration System';
						$message = "Hi ". $fname .", \n\nYou have been assigned a temporary password [ ". $temp_psword . " ].\n
							Click here to log in with your new password.\nhttp://aristotleii.monmouth.edu/~jwang/SE357/index.php\n\n
							This is a system email. Please do not reply!\n\nThank You!\n\nMonmouth University Online Registration System";
						$headers = 'From: Online Registration System' . "\r\n" .
    								'Reply-To: ' . "\r\n" .
    								'X-Mailer: PHP/' . phpversion();
						mail($to, $subject, $message, $headers);
						echo "<p class='err'>An email with a temporal password has been sent to you.</p>";
					}
					
				}
				else {
					echo "<p class='err'>Your username does not exist! Please enter again!</p>";
				}
			}
		}
	?>
	
	
	<form action = "" method = "POST">
		<p>
			Please enter your username here. A temporary password will be sent to your email account.
		</p>

		<input type = "text" name = "userid" value = <?php echo $userid; ?> >

		<input type = "submit" name = "reset" value = "Reset" />
		<input type = "submit" name = "back" value = "Back" />
	</form>

	
	</div>
  </div>
</body>
	<footer>
		&copy Monmouth University 2020
	</footer>
</html>