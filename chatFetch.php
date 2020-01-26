<?php
include_once('config.php');
$result= mysqli_query($conn , "SELECT * FROM chatroom");
while ($row = mysqli_fetch_assoc($result)){
	echo $row['start_user']." :";
	echo $row['content']."<br>";
	
	}
?>