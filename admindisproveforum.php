<?php

include('config.php');
ob_start();
session_start();
?>

<!DOCTYPE HTML>

<html>
<head>
<title>Disapprove a Forum</title>

</head>

<body>

<?php
// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
if (isset($_GET['forumname']))

{

$forumname = $_GET['forumname'];//save the data to the database

$result = mysql_query("UPDATE forum SET status = 'rejected' WHERE forumname= '$forumname'");

if($result){
  header("Location: adminforumreq.php");
  echo "You have Successfully rejected";
  echo $forumname;
} else {
  echo "Error publishing ";
  echo $forumname;
}

}

// once saved, redirect back to the view page
?>
