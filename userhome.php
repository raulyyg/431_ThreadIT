<?php
require_once 'config.php';
ob_start();
session_start();


?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome <?php echo  $_SESSION['fullname'];?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css">
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
      </div>
    </nav>
    <div class="container">
      <div class="jumbotron">
        <h1>Welcome <?php echo  $_SESSION['fullname'];?> to your homepage!</h1>
        <p>Start exploring our forums!</p>
        <p><a class="btn btn-primary btn-lg" href="forum_mainforum.php" role="button">Explore Forums</a></p>
      </div>
  </div>
</div>

  </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</html>


<?php ob_end_flush(); ?>
