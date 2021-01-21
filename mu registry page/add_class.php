<html>
    <head>
        <title>SE357/537</title>
        <link rel="stylesheet" type="text/css" href="includes/myStyle.css">
    </head>
    <body>

    <?php 

/*
        session_start();
		if(empty($_SESSION) || $_SESSION['role'] == 'student'){
			//user has not logged in. redirect to the login papge
			echo "<script>window.open('login.php', '_SELF')</script>";
			exit();
        }
*/
    	//Check cookies
    	if(!isset($_COOKIE['userid']) || $_COOKIE['role'] != 'admin'){
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
  
        include "includes/functions.php";   //all functions	
        navigation();
      
      	$types=array("TY"=>"Type", "IN"=>"In Class", "HY"=>"Hybrid", "ONS"=>"Online Sync", "ONAS"=>"Online Async");
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
			$err = array();
            
            // Class code
			$classcode=$_POST['classcode'];
			if(!preg_match("/^([A-Z]){2}-([0-9]){3}-([0-9]{2})$/", $classcode)){
				$err['classcode']="Invalid classcode.";
            }
            
            // Class name
			$classname=$_POST['classname'];
			if(!preg_match("/^([A-Z]|[a-z]|( )){2,}$/", $classname)){
				$err['classname']="Invalid classname.";
            }
            
           
            // location
			$location=$_POST['location'];
			if(!preg_match("/^([A-Z]){1,2}-([0-9]){3}$/", $location)){
				$err['location']="Invalid location.";
            }

            // Instructor
            $instructor=$_POST['instructor'];
			if(!preg_match("/^([A-Z]|[a-z]){3,}$/", $instructor)){
				$err['instructor']="Invalid instructor.";
            }
            
            // Time
            $time = $_POST['time'];
			if(!preg_match("/^(MO|TU|WE|TH|FR) ([0-9]{2}:[0-9]{2}(AM|PM))-([0-9]{2}:[0-9]{2}(AM|PM))+$/", $time)){
				$err['time']="Invalid time.";
			}
			
            
            // Check to make sure they chose a type
            $type=$_POST['type'];
            if($type == 'TY'){
                $err['type'] = "Type is required.";
            }
            else{
            	$type=$types[$type];    //get value from a key
            }
        
            if(empty($err)){
                $myConn = db_connection_win();
    
                $query = "INSERT INTO classes (classcode, classname, location, instructor, time, type)
                          VALUES('$classcode', '$classname','$location', '$instructor', '$time', '$type')";
					
				$res=mysqli_query($myConn,$query);
				if($res){
						echo "<p class = 'err'>The class is added.</p>";
						$_POST=array();
				}
				else
						echo "<p class='err'> ERROR!</p>";		

            } 
        }

        
    ?>

<div id="container">

    <form action="<?php echo $_SERVER[PHP_SELF]; ?>" method="post">
            
            <h3>Add a Class</h3>

            <p class="err">* required field</p>

            <input type="text" name="classcode" value="<?php echo $_POST['classcode'];?>" placeholder="Class Code..." required>
				<span class="err">*<?php echo $err['classcode'] ?></span><br>

            <input type="text" name="classname" value="<?php echo $_POST['classname'];?>" placeholder="Class Name..." required>
				<span class="err">*<?php echo $err['classname'] ?></span><br>

            <input type="text" name="location" value="<?php echo $_POST['location'];?>" placeholder="Location..." required>
				<span class="err">*<?php echo $err['location'] ?></span><br>
            
            <input type="text" name="instructor" value="<?php echo $_POST['instructor'];?>" placeholder="Instructor..." required>
				<span class="err">*<?php echo $err['instructor'] ?></span><br>
			
			<input type="text" name="time" value="<?php echo $_POST['time'];?>" placeholder="Time..." required>
				<span class="err">*<?php echo $err['time'] ?></span><br>
			
			<?php
			
		
				echo '<select name="type"> required';
				dropdown_menu($types, $_POST['type']);
				echo '</select>';
                //echo "<span class='err'> *</span><br>";
			?>
			<span class="err">*<?php echo $err['type'] ?></span><br>


			<input type="submit" name="submit" value="Submit"><br>
			
		</form>	

        </div>   <!-- container -->

    </body>
</html>