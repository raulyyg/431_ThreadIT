<?php
//Main forum page that displays forums
ob_start();
session_start();
require_once 'config.php';

$userStatus = $_SESSION['status'];
//var_dump($userStatus);
//die();


//select all open forums
$sql="SELECT * FROM forum WHERE status = 'open' ORDER BY forumname DESC";
// OREDER BY id DESC is order result by descending

$result=mysql_query($sql) or die (mysql_error());
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome <?php echo  $_SESSION['fullname'];?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
  </head>


  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">ThreadIt</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="messages.php">Messages</a></li>
          <li><a href="#">Chatrooms</a></li>
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
      </div>
    </nav>
    <!--Display Current Forums-->
    <div class="container">
      <div class="row">
    <h1>FORUMS

    <?php
    //code to check if moderator
    if($userStatus=='moderator' ){

    ?>
      <a type="button" class="btn btn-info" href="moderatorforums.php">Manage Forums</a>
  <?php
}

   ?>
    </h1>
  </div>
    <div class="row">

<?php

// Start looping table row
    $rows = mysql_fetch_array($result);
while($rows) {
?>

  <div class="media">
    <div class="media-left">
      <a href="main_forum.php?forumname=<?php echo $rows['forumname']; ?>">
        <img id="forumthumb" src="<?php echo $rows['picture']; ?>">
      </a>
    </div>
    <div class ="media-body">
        <h4 class="media-heading"><a href="main_forum.php?forumname=<?php echo $rows['forumname']; ?>"><?php echo $rows['forumname']; ?></a></h3>
        <p><?php echo $rows['description']; ?></p>
        <small>Moderator: <?php echo $rows['moderator']; ?></small>
    </div>
  </div>

<?php
$rows = mysql_fetch_array($result);

// Exit looping and close connection
}
mysql_close();
?>
</div>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
