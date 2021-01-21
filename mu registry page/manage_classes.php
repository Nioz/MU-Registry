<html>
<head>
	<title>SE357/517</title>
	<link rel = "stylesheet" type = "text/css" href = "includes/myStyle.css" />
</head>

<body>
<?php 
		session_start();
		if(empty($_SESSION)){
			//$_SESSION is empty, user has not logged in. redirect to the login papge
			echo "<script>window.open('login.php', '_SELF')</script>";
			exit();
        }
        $userid = $_SESSION['userid'];
        
        include "includes/functions.php";
		navigation();
	
			
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			//retrieve form data
			
            $program = $_POST['program'];
            $err = array();
            
			//connect to database
			$myConn = db_connection_win();
			
							
            $q = "SELECT * FROM classes WHERE classcode LIKE '$program%'";
				
			
			$r = mysqli_query($myConn, $q);
            echo "<table>";
            echo "<tr>";
            echo "<th>Class Code</th>";
            echo "<th>Class Name</th>";
            echo "<th>Location</th>";
            echo "<th>Instructor</th>";
            echo "<th>Time</th>";
            echo "<th>Type</th>";
            echo "<th>Edit</th>";
            echo "<th>Delete</th>";
            echo "</tr>";
            while($row = mysqli_fetch_assoc($r)) {
                echo "<tr>";
                echo "<td>".$row['classcode']."</td>";
                echo "<td>".$row['classname']."</td>";
                echo "<td>".$row['location']."</td>";
                echo "<td>".$row['instructor']."</td>";
                echo "<td>".$row['time']."</td>";
                echo "<td>".$row['type']."</td>";
                echo "<td><a href='edit_class.php?'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Do you really want to delete this course?');\"href='delete_class.php?classcode=".$row['classcode']."&userid=".$userid."'>Delete</a></td>";
                echo "</tr>";
                } 
                echo "</table>";
            }
          
            
	?>	
		<h3>Select a program:</h3>
	<form action="" method="POST">
			
				<?php
                $program = array(""=>"Please select a program", "SE"=>"Software Engineering", 
                                    "CS"=>"Computer Science", "MA"=>"Mathematics");	
                    
                echo'<select name= "program"> required';
                dropdown_menu($program, $_POST['program']);
                
                ?>
            	
            <br>
            <input type="submit" name="submit" value="Submit" >	

			<br><br>
		   	
	</form>
		
	</div>   

	<footer> &copy Monmouth University 2020 </footer>
<body>
</html>
