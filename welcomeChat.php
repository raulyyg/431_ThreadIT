<?php
session_start();
require_once 'config.php';

//if session is not set this will redirect to login page
if(!isset($_SESSION['user']) ) {
header("Location: index.php");
exit;
}

$user = $_SESSION['user'];
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Welcome <?php echo  $_SESSION['fullname'];?></title>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--<script src="js/main.js"></script>-->
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="userhome.php">ThreadIt</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="userhome.php">Home</a></li>
        <li><a href="messages.php">Messages</a></li>
        <li><a href="welcomeChat.php">Chatrooms</a></li>
        <li><a href="forum_mainforum.php">Forums</a></li>
        <?php
        //Display Admin Dashboard for admins
        if($_SESSION['status'] == 'admin'){
        ?>
        <li><a href="adminmanageusers.php">Manage Users</a></li>
        <li><a href="adminforumreq.php">Manage Forums</a></li>
        <?php
        }
         ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="glyphicon glyphicon-user"></span>
                      <strong><?php echo  $_SESSION['fullname'];?></strong>
                      <span class="glyphicon glyphicon-chevron-down"></span>
                  </a>
                  <ul class="dropdown-menu">
                      <li><a href="messages.php">Messages</li>
                      <li class="divider"></li>
                      <li><a href="projectlogout.php">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                  </ul>
              </li>
        </ul>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>HomePage for Chatroom</title>
<link rel= "stylesheet" type= "text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>




<style>
.jumbotron{
    background-color:#2E2D88;
    color:white;
}
/* Adds borders for tabs */
.tab-content {
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    padding: 10px;
}
.nav-tabs {
    margin-bottom: 0;
}
</style>




<!-- CONTAINERS -->
<!-- container puts padding around itself while container-fluid fills the whole screen. Bootstap grids require a container. -->
<div class="container">
 
<!-- page-header adds space aroundtext and enlarges it. It also adds an underline at the end -->
<div class="page-header">
<h1>Welcome to ThreadIt's Chat Room!</h1>
</div>
 
<!-- jumbotron enlarges fonts and puts everything in a gray box with rounded corners. If jumbotron is outside a container it fills the total width. You can change the styles by placing the changes after the Bootstrap CDN link -->
<div class="jumbotron">
<p>This chatroom allows you to communicate with all of ThreadIts' users instantly! Please click enter to join the 431 Chat Room session. Otherwise, Click 'Go Back' to take you back to the homepage.</p>


<p>
<center>
<form action="userhome.php" method="post">
<button type="submit" class = "btn btn-danger" role = "button">GO BACK</button></center>
</form></p>
<p>
<center>
<form action="chatroom.php" method="post">
<button type="submit" class = "btn btn-danger" role = "button">JOIN</button></center>
</form>
</p>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- Use downloaded version of Bootstrap -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>