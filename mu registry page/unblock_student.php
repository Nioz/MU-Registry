<html>
<head>
	<title>SE357/517</title>
	<link rel = "stylesheet" type = "text/css" href = "includes/myStyle.css" />
</head>

<body>
<?php 
        
        include "includes/functions.php";
		navigation();
			
           
            
			//connect to database
			$myConn = db_connection_win();
            
            $roles = $_GET['roles'];
            $userid = $_GET['userid'];

            
            $p = "UPDATE users SET blocked = 0 WHERE userid = '$userid'";
            
			
			mysqli_query($myConn, $p);

	?>	
	
	</div>   

	<footer> &copy Monmouth University 2020 </footer>
<body>
</html>
