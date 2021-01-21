<!--
	page for user sign up, from home work assignment 3
	user does not need to log in to access this page
-->

<html>
	<head>
		<title>Sign Up</title>
		<link rel = "stylesheet" type = "text/css" href = "includes/myStyle.css" />
	</head>

	<body>		
	<?php
		include "includes/functions.php";   //all functiona
		navigation();
		
		echo '<div id="container">';
		
		//process form data
		//if no problem, insert them to database and then display the data in the users table
		if ($_SERVER['REQUEST_METHOD'] =='POST'){
			$err = array();   //to store all error messages

			//retrieve form data
			$userid = $_POST['userid'];
			$password = $_POST['password'];
			$cpassword = $_POST['cpassword'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$role = $_POST['role'];

			//english letters and numbers only. numbers optional.
			//this pattern ensures at least one letter
			If(!preg_match("/^[A-Za-z0-9]+$/", $userid)
				|| !preg_match("/[A-Za-z]/", $userid)){
				$err['userid']="Invalid User Name";
			}

			//at least seven english letters and at least one "_"
			//"/^([A-Z]|[a-z]|_){8,}$/" ensures at least 8 of letters and _ in total.
			if(!preg_match("/^([A-Z]|[a-z]|_){8,}$/", $password)){
				$err['password']="Invalid password";
			}
			else{
				$underscore=substr_count($password,'_');  //# of _
				$len=strlen($password);   //total # of letters and _'s
				$letters=$len-$underscore;   //total # of letters
				if($underscore==0 || $letters<7){  //make sure #letters>7 and #_'s>0
					$err['password']="Invalid password";
				}
			}
	
		/* Jill
				if(!preg_match("/^\w{8,}$/", $psword)|| !preg_match("/[a-zA-Z]{7,}/", $psword) || !preg_match("/_+/", $psword) || preg_match("/[0-9]/", $psword)) {
					$err['password'] = "Invalid password";
				}	
		*/
				
			//two passwords matach?
			if($password!=$cpassword){
				$err['cpassword']="Does not match the password.";
			}
			
			//if first letter starts uppercase the code begins with [A-Z]([A-Z]|[a-z])
			//contains enlgish letters only
			if(!preg_match("/^([A-Z]|[a-z])+$/", $fname)){
				$err['fname']="Invalid first name.";
			}
			
			// contains english letters only
			if(!preg_match("/^([A-Z]|[a-z])+$/", $lname)){
				$err['lname']="Invalid last name.";
			}
			
			//in the form xxx@gmail.com, where xxx must start with an english letter
			//may have digits 
			$email=$_POST['email'];
			if(!preg_match("/^[A-Za-z]([A-Za-z0-9])+@gmail\.com$/", $email)){
				$err['email']="Invalid email.";
			}

			
			if (empty($err)){
					//form data okay. insert to the users table.
					
					//connect to the server
					$myConn=db_connection_win();

					//define the insert query based on role (admin is unblocked, student is blocked by default)
					if($role == 'admin') 
					{
						$q="INSERT INTO users (userid, psword, fname, lname, email, roles, blocked)
						VALUES ('$userid','$password', '$fname', '$lname', '$email', '$role', '0')";
					} 
					else 
						$q="INSERT INTO users (userid, psword, fname, lname, email, roles, blocked)
						VALUES ('$userid','$password', '$fname', '$lname', '$email', '$role', '1')";
					
					//execute the query
					$r=mysqli_query($myConn, $q);

					//if data inserted successfully, display the users table
					//this is for testing only. removed it when the code is finalized.
					//it can be implemented as view_users.php
					if($r){
					
						//clean up the form data
						$_POST=array();

						//define the select (read) query
						$q="SELECT * FROM users";
						
						//execute the query
						$r=mysqli_query($myConn, $q);

						if(mysqli_num_rows($r)>0){
						//display the users table data
							echo "<table id='tbl'>";
							echo "<tr>";
							echo "<th>user id</th>";
							echo "<th>password</th>";
							echo "<th>first name</th>";
							echo "<th>last name</th>";
							echo "<th>email</th>";
							echo "<th>role</th>";
							echo "<th>blocked</th>";
							echo "</tr>";
							while($row=mysqli_fetch_assoc($r)){
									echo "<tr>";
									echo "<td>".$row['userid']."</td>";
									echo "<td>".$row['password']."</td>";
									echo "<td>".$row['fname']."</td>";
									echo "<td>".$row['lname']."</td>";
									echo "<td>".$row['email']."</td>";
									echo "<td>".$row['role']."</td>";
									echo "<td>".$row['blocked']."</td>";
									echo "</tr>";
							}
							echo "</table>";
						}
					}
					else {
						//the insertion action is failed
						echo "Inserting data to table is failed.";
					}
			}

		}
	?>
<!-- // above ends the php code  -->

<!-- // below sets up the input setup for the data and notes all info is required -->
		<h3> The New MU Users Form</h3>

		<p class="err">* All fields required</p>

		<!-- //allows data to be inputed throughout  -->
		<form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post">
<!-- //creates data for userID input and the
The * reminds user it is required  -->
			<input type="text" name="userid" value="<?php echo $_POST['userid'];?>"
			placeholder="userid..." required>
				<span class="err"><?php echo $err['userid'] ?></span><br>
				
<!-- //creates data for password  -->
			<input type="text" name="password" value="<?php echo $_POST['password'];?>"
			placeholder="password..." required>
				<span class="err">*<?php echo $err['password']; ?><br>
				
<!-- //creates data to re-confirm the passsword  -->
			<input type="text" name="cpassword" value="<?php echo $_POST['cpassword'];?>"
			placeholder="confirm password..." required>
				<span class="err">*<?php echo $err['cpassword']; ?><br>
				
<!-- //creates data for first name input  -->
			<input type="text" name="fname" value="<?php echo $_POST['fname'];?>"
			placeholder="first name..." required>
				<span class="err">*<?php echo $err['fname']; ?><br>
				
<!-- //creates data for last name input  -->
			<input type="text" name="lname" value="<?php echo $_POST['lname'];?>"
			placeholder="last name..." required>
				<span class="err">*<?php echo $err['lname']; ?><br>
				
<!-- //creates data for email input  -->
			<input type="text" name="email" value="<?php echo $_POST['email'];?>"
			placeholder="email..." required>
				<span class="err">*<?php echo $err['email'] ?></span><br>

<!-- //creates dropdwon menu -->
				<?php
					$role=array("admin"=>"admin", "instructor"=>"instructor",
						"student"=>"student");
					echo '<select name="role">';
					dropdown_menu($role, $_POST['role']);
					echo '</select><br>';
				?>

<!-- //what is this thing  -->
				<span class="err"><?php echo $err['role'] ?></span><br>

<!-- //creates submit button -->
				<input type="submit" name='submit' value="Submit"><br>

		</form>
	</div> <!-- container -->
</body>
<footer>&copy Monmouth University</footer>
</html>
