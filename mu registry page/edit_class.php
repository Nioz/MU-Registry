<html>
	<head>
		<title> Add Class </title>
		<link rel="stylesheet" type="text/css" href="includes/myStyle.css">
	
       
    
    </head>
	
	<body>
		<!-- heading tag -->
		
		
		<?php
    
        session_start();
        
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
			include "includes/functions.php";
            navigation();
            
		
		
		
		
         
			// php code to processing the form data
			if($_SERVER['REQUEST_METHOD']=='POST'){  //true if form is submitted
                //retrieve data from $_POST
			   
				$classcode = $_GET['classcode'];
                $classname = $_POST['classname'];
                $location = $_POST['location'];
				$instructor = $_POST['instructor'];
                $time = $_POST['time'];
                $type = $_POST['type'];
               
                
                
                

				// validate form data

				// create an array to store errors
                $err = array();
               
                // validate classname
				if(!preg_match("/^[A-Za-z]+[A-Za-z ]*$/", $classname)) {
					$err['classname'] = "Class name is invalid.";
                }
                
				// validate location
				if (!preg_match("/^[A-Z][A-Z]?-[0-9]{3}$/", $location)) {
					$err['location'] = "Location is invalid.";
				}

				// validate instructor
				if (!preg_match("/^[A-Za-z]+$/", $instructor)) {
					$err['instructor'] = "Instructor is invalid.";
                }
            

				// validate time
				if (!preg_match("/^(MO|TU|WE|TH|FR) [0-9]{2}:[0-9]{2}(AM|PM)-[0-9]{2}:[0-9]{2}(AM|PM)$/", $time)) {
					$err['time'] = "Time is invalid.";
                }
				
                
                
				// validation results
                if (empty($err)) {			// no error
                    echo"<p class='err'>Form validated.</p>";
                    $myConn = db_connection();

                    $q ="UPDATE classes SET classname = '$classname', location = '$location',
                                            instructor = '$instructor', time = '$time',
                                            type = '$type' WHERE classcode ='$classcode'";

                    $r = mysqli_query($myConn, $q);

                    if ($r) {
                        $_POST = array(); // clean up $_POST and thus the form
                        
                    } else
                        echo "<p class='err'>Data insertion failed.</p>";
                        
				}
					
			}
            $myConn = db_connection();

            $q = "SELECT * FROM classes WHERE classcode ='$classcode'";
            $r = mysqli_query($myConn, $q);

            if(mysqli_num_rows($r)>0){
            "<table>";
            "<tr>";
            "<th>Class Code</th>";
            "<th>Class Name</th>";
            "<th>Location</th>";
            "<th>Instructor</th>";
            "<th>Time</th>";
            "<th>Type</th>";
            "</tr>";
            
            while($row=mysqli_fetch_assoc($r)){
            "<tr>";
            "<td>".$row['classcode']."</td>";
            "<td>".$row['classname']."</td>";
            "<td>".$row['location']."</td>";
            "<td>".$row['instructor']."</td>";
            "<td>".$row['time']."</td>";
            "<td>".$row['type']."</td>";

            $classname = $row['classname'];
            $location = $row['location'];
            $instructor = $row['instructor'];
            $time = $row['time'];
            $type = $row['type'];
            "</tr>";
            $types=array("TY"=>"Type", "In-Class"=>"In Class", "Hybrid"=>"Hybrid", "Online-Sync"=>"Online Sync", "Online-Async"=>"Online Async");

        }
            "</table>";
        }

		?>
	
		
		<fieldset>
		
		<form action="" method="POST">

        <h3>Edit <?php echo $classcode;?></h3>

        <p class="err">* required field</p>

            <input type="hidden" name="classcode" value="<?php echo $classcode;?>"><br>
			<label for="classname">Class name: </label>
			<input type="text" id="classname" name="classname" value = "<?php echo $classname?>"
				placeholder="Letters only." required>
            <span class="err">*</span><br>

            <label for="location">Location: </label>
			<input type="text" id="location" name="location" value="<?php echo $location;?>"
				placeholder="XX-111" required>
            <span class="err">*</span><br>
            
            <label for="instructor">Instructor: </label>
			<input type="text" id="instructor" name="instructor" value = "<?php echo $instructor ?>"
				placeholder="Must start with capital letter." required>
            <span class="err">*</span><br>

			<label for="time">Time: </label>
			<input type="text" id="time" name="time" value="<?php echo $time; ?>"
				placeholder="" required>
            <span class="err">*</span><br>

            <?php


				echo '<select name="type"> required';
				dropdown_menu($types, $_POST['type']);
					echo '</select>';
                //echo "<span class='err'> </span><br>";
               
				?>


        
            <br>

			<br><br>
			<input type="submit" value="Submit">
		</form>
		</fieldset>
		
		</div> <!-- container -->
	</body>
	
	<footer>
		Copyright@Monmouth University 2020
	</footer>
