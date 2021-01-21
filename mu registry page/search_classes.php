<html>
	<head>
		<title>SE357/537</title>
		<link rel="stylesheet" type="text/css" href="includes/myStyle.css">
	</head>
	<body>
    <?php
       
        include "includes/functions.php";   //all functions	
        navigation();
    ?>	
    
    <div id="container">
    
		
	<form acton="<?php echo $_SERVER[PHP_SELF]; ?>" method="POST">
            <h3>Search for Classes by Program</h3>

            <p class="err">* required field</p>

            <?php
				$codes=array("TY"=>"Select a Program", 
							"CS"=>"Computer Science", 
							"SE"=>"Software Engineering", 
							"IS"=>"Information Systems", 
							"MA"=>"Mathematics");
		
				echo '<select name="code"> required';
				dropdown_menu($codes, $_POST['code']);
                echo '</select>';

			?>
			<span class="err">* <?php echo $err['type'] ?></span><br>


			<input type="submit" name="submit" value="Search"><br>
    </form>
    
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
			//retrieve form data
            $code = $_POST['code'];
                            $type=$_POST['code'];
            if($code == 'TY'){
                    $err['code'] = "Program is required.";
            }
		
            if(empty($err)){
                        
                //connect to the server
                $myConn = db_connection_win();
                
                //define a query to select the record for the userid				
                $q = "SELECT * FROM classes WHERE classcode LIKE '$code%'";
                    
                //execute the query, return data is referenced by $r
                $r = mysqli_query($myConn, $q);

                //find the record, cannot be more than one because userid is the primary key
                if (mysqli_num_rows($r) > 0){
                    //save the record to an array $row
                    // $row = mysqli_fetch_array($r);
                    // echo $row[0];

                    $th = array("Class Code", "Class Name", "Location", "Instructor", "Time", "Type");
                    
                    echo "<table id='tbl'>";
                    	echo "<tr>";
				
						foreach($th as $member){
							echo "<th>$member</th>";
						}
						echo "</tr>";
                    //$count = mysqli_num_rows($r);
                    while($row=mysqli_fetch_assoc($r)){
                        echo "<tr>";
                        echo "<td>".$row['classcode']."</td>";
                        echo "<td>".$row['classname']."</td>";
                        echo "<td>".$row['location']."</td>";
                        echo "<td>".$row['instructor']."</td>";
                        echo "<td>".$row['time']."</td>";
                        echo "<td>".$row['type']."</td>";
				
                        echo "</tr>";
                    }
                    
                    echo "</table>";

                }
                else
                    echo "<p class='err'>No Classes Found.</p>";	
            } 
		}
    ?>
		
	</div>   <!-- container -->

    </body>
    <footer>&copy Monmouth University 2020</footer>
</html>