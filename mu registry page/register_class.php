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
		
		echo '<div id="container">';
			
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$err = array();

		$classcode = $_POST['clcode'];
		if (!preg_match("/^([A-Z]){2}$/", $classcode)) {
			$err['clcode'] = 'Invalid classcode';
		}
		
		$userid = $_SESSION['userid'];
		
		if(empty($err))
		{
			$myConn = db_connection_win();

			$query = "SELECT * FROM classes WHERE classcode LIKE '%{$classcode}%'";
			$result = mysqli_query($myConn, $query);

			if($result)
			{
				//$_POST=array();

				//define the select (read) query
					$q="SELECT * FROM classes WHERE classcode LIKE '%{$classcode}%'";
						
				//execute the query
					$r=mysqli_query($myConn, $q);

				if(mysqli_num_rows($r)>0){
					//display the users table data
					echo "<table id='tbl'>";
					echo "<tr>";
					echo "<th>Class Code</th>";
					echo "<th>Class Name</th>";
					echo "<th>Location</th>";
					echo "<th>Instructor</th>";
					echo "<th>Class Time</th>";
					echo "<th>Class Type</th>";
					echo "<th>Action</th>";
					echo "</tr>";
					while($row=mysqli_fetch_assoc($r)){
						echo "<tr>";
						echo "<td>".$row['classcode']."</td>";
						echo "<td>".$row['classname']."</td>";
						echo "<td>".$row['location']."</td>";
						echo "<td>".$row['instructor']."</td>";
						echo "<td>".$row['time']."</td>";
						echo "<td>".$row['type']."</td>";
						echo "<td><a onClick=\"javascript: return confirm('Do you really want to register this course?');\"  
							href = 'do_registration.php?classcode=".$row['classcode']."&userid=".$userid."'>Register</a></td>"; 					
						echo "</tr>";
					}
					echo "</table>";
				}
			}
			else
			{
				echo "<p class = 'err'>Registration is failed.<\p>";
			}
		}
		}
	?>
	<h3> Select a program:</h3>

	<form action="" method="post">
		<?php
		$clcode = array("CS"=>"Computer Science","SE"=>"Software Engineering","IS"=>"Information Systems","MA"=>"Mathematics");
		
		echo '<select name="clcode"> required';
				dropdown_menu($clcode, $_POST['clcode']);
		echo '</select>';
		?>
		<input type="submit" name="submit" value="Submit"><br>
	</form>
	</div>
	</body>
	<footer>&copy Monmouth University 2020</footer>
</html>