<?php

	function dropdown_menu($asc_array,$selected){
		foreach($asc_array as $key=>$value){
			//echo "<option value=$key>$value</option>";
			echo "<option ";
			if($key==$selected)echo "selected='selected'";
			echo "value=$key>$value</option>";
		}
	}
		
	function navigation(){
		echo '
		<h1>Monmouth University Class Registration System</h1>
		<ul class="nav">';

            session_start();
            
            if(empty($_SESSION)){   //case 1: user not logged in
            	echo '<li class = "nav"> <a href = "index.php">Home</a></li>';
            	echo '<li class = "nav"><a href = "search_classes.php">Search Classes</a></li>';
            	
            	//allow user to log in
            	echo '<li class = "nav"><a href = "login.php">Log In</a></li>';
           	}
           	else { //cases 2&3: user logged in
           		$userid = $_SESSION['userid'];
           		$role = $_SESSION['role'];
           		$fname = $_SESSION['fname'];
           		
            	if ($role == "student") { //case 2: user is a student
            		echo '<li class = "nav"><a href = "my_registration.php">My Registration</a></li>';
            		echo '<li class = "nav"><a href = "register_class.php">Register Class</a></li>';
            		echo '<li class = "nav"><a href = "deregister_class.php">Deregister Class</a></li>';
            		echo '<li class = "nav"><a href = "change_psword.php">Change Password</a></li>';
            	}
            	else {  //case 3: user is an admin
               		echo '<li class = "nav"><a href = "add_class.php">Add Class</a></li>';
            		echo '<li class = "nav"><a href = "manage_classes.php">Manage Class</a></li>';
            		echo '<li class = "nav"><a href = "manage_registration.php">Manage Registration</a></li>';
            		echo '<li class = "nav"><a href = "manage_users.php">Manage Users</a></li>';
            		echo '<li class = "nav"><a href = "change_psword.php">Change Password</a></li>';
            		
            	}  
            	
            	//allow user to log out
            	echo '<li class = "nav"><a href = "index.php">Log Out</a></li>'; 

				//a welcome message for logged-in user
            	echo '<li class = "navWelcome">Welcome, '.$fname.'!</li>';  
            	
            } 
            
		echo '</ul>';
	}
	
	
	function db_connection(){   //for Mac
		$myConn = mysqli_connect("localhost", "root", "root", "registration")
						or die("Connection failed");
		return $myConn;
	}
	
	function db_connection_win(){	//for Windows
		$port = 3307;
		$myConn = mysqli_connect("localhost:$port", "root", "root", "registration")
						or die("Connection failed");
		return $myConn;
	}
	
	function randomString($length) {
  		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   		$charactersLength = strlen($characters);
    	$randomString = '';
    		
    	for ($i = 0; $i < $length; $i++) {
        	$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	
    	return $randomString;
	}
	
?>