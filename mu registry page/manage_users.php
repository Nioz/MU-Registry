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
	
			//retrieve form data
            $err = array();
            
			//connect to database
			$myConn = db_connection_win();
			
							
            $q = "SELECT * FROM users WHERE roles LIKE 'student'";
				
			
			$r = mysqli_query($myConn, $q);
            echo "<table>";
            echo "<tr>";
            echo "<th>UserID</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Email</th>";
            echo "<th>Status</th>";
            echo "</tr>";
            while($row = mysqli_fetch_assoc($r)) {
                echo "<tr>";
                echo "<td>".$row['userid']."</td>";
                echo "<td>".$row['fname']."</td>";
                echo "<td>".$row['lname']."</td>";
                echo "<td>".$row['email']."</td>";
                if($row['blocked'] == 0) {
                    echo "<td>"."Unblocked"."</td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to block this student?');\"href='block_student.php?roles=".$row['roles']."&userid=".$row['userid']."'>Block</a></td>";
                }
                else {
                    echo "<td>"."Blocked"."</td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to unblock this student?');\"href='unblock_student.php?roles=".$row['roles']."&userid=".$row['userid']."'>Unblock</a></td>";
                }
                echo "</tr>";
                } 
                echo "</table>";
          
            
	?>	


	<footer> &copy Monmouth University 2020 </footer>
<body>
</html>
