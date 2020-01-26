<?php

include('config.php');
ob_start();
session_start();
?>

<!DOCTYPE HTML>

<html>
<head>
<title>Ban a User</title>

</head>

<body>

<?php
// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
if (isset($_GET['username']))

{

$username = $_GET['username'];//save the data to the database

$result = mysql_query("UPDATE users SET status = 'moderator' WHERE username= '$username'");

if($result){
  header("Location: adminhome.php");
  echo "You have Successfully set";
  echo $username;
  echo "as a moderator";
} else {
  echo "Error setting as moderator";
  echo $username;
}

}

// once saved, redirect back to the view page
?>
