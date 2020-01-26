<?php

/* 
THIS CODE RETRIEVES USERS IN TABLE: 'USERS'. CHECKS THE STATUS OF THE USER WITH A 0 OR 1 TO CHECK
IF THE USER IS ONLINE OR NOT. PASSES DATA SUCH AS USERNAME, PASSWORD, AND FULLNAME ONTO THE CHATROOM   
*/

session_start();
include_once('config.php');
$username = $_POST['username'];
$password = $_POST['password'];
					
					$result = mysqli_query($conn , "SELECT * FROM users WHERE username ='$username'");
					while($row = mysqli_fetch_assoc($result))
					{
						$fullname = $row['fullname'];
						}
					
					
					if(mysqli_num_rows($result)>0){
						echo "success";
						$_SESSION['username'] = $username;
						$_SESSION['password'] = $password;
						$_SESSION['fullname'] = $fullname;
						
						$query = mysqli_query($conn,"UPDATE users
SET status = 'A'
WHERE username = '$username';");
						
						header('location: chatroom.php'); 
						
						}
						else {

							//CHECKS IF USER EXISTS IN DB
							echo "failedYYYY";
							header('location: practice.php?login_error=<span style="color:red">Failed to connec to chartroom server!</span>');
							}	
					
	

 ?>
