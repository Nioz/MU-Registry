<html>

	<head>
		<link rel="stylesheet" href="includes/myStyle.css">
	<title> Change Password </title>
	</head>

	<body>
		
	<?php 

		include "includes/functions.php";
		navigation();
	
		if ($_SERVER['REQUEST_METHOD'] =='POST'){
			$err = array();
			$userid = $_POST['userid'];
			$password = $_POST['password'];
			$cpassword = $_POST['cpassword'];
			$npassword = $_POST['npassword'];


			if(!preg_match("/^([A-Z]|[a-z]|_){8,}$/", $npassword)){
				$err['npassword']="Invalid password";
			}
			else{
				$underscore=substr_count($npassword,'_');  //# of _
				$len=strlen($npassword);
				$letters=$len-$underscore;
				if($underscore==0 || $letters<7){
					$err['npassword']="Invalid password";
				}
			}
			
			if($npassword!=$cpassword){
				$err['cpassword']="Does not match the password.";
			}
			
			
			if (empty($err)){
					//hashing the password
					$password = SHA1($password);
					$npassword = SHA1($npassword);
					
					//connect to the server
					$myConn=db_connection_win();
					
					$r=mysqli_query($myConn, "SELECT userid,password FROM users WHERE userid = '$userid' AND password = '$password'");

					if((mysqli_num_rows($r) == 1)) {
						$r = mysqli_query($myConn, "UPDATE users SET password = '$npassword' WHERE userid ='$userid'");
						
						if($r){
							echo '<p class="err">Password is changed.</p>';
							$_POST = array();
						}
						else {
							echo '<p class="err">Password update is failed.</p>';
						}
					}
					else {
						echo '<p class="err">Invalid userid or password.</p>';
					}
			}
		}
	?>

	<h3> Change password:</h3>

		<p class="err">* All fields required</p>


		<form action="" method="post">

			<input type="text" name="userid" value="<?php echo $_POST['userid'];?>"
			placeholder="confirm user ID" required>
				<span class="err">*<?php echo $err['userid']; ?><br>

			<input type="text" name="password" value="<?php echo $_POST['password'];?>"
			placeholder="current password" required>
				<span class="err">*<?php echo $err['password']; ?><br>

<!-- //creates data for NEW password  -->
			<input type="text" name="npassword" value="<?php echo $_POST['npassword'];?>"
			placeholder="new password" required>
				<span class="err">*<?php echo $err['npassword']; ?><br>
				
<!-- //creates data to re-confirm the NEW passsword  -->
			<input type="text" name="cpassword" value="<?php echo $_POST['cpassword'];?>"
			placeholder="confirm new password" required>
				<span class="err">*<?php echo $err['cpassword']; ?> <br>
				
			<input type="submit" name='submit' value="Submit"><br>

		</form>
	</div> 
	</body>
</html>
