
<?php

//Check if user is online!

include_once('config.php');
$result= mysqli_query($conn , "SELECT * FROM users");
while ($row = mysqli_fetch_assoc($result)){
	if($row['status'] == 'A' ){
		echo "<font color='#009900'>".$row['fullname']." (Online)"."</font><br>";
		}
		else{
				echo "<font color='#FF0000'>".$row['fullname']." (Offline)"."</font><br>";
			}
	}

?>
