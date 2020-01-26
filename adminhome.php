<?php
require_once 'config.php';
ob_start();
session_start();
if($_SESSION['status'] == 'admin'){
//Selects all Forums
$sql="SELECT * FROM users ORDER BY fullname";
// OREDER BY id DESC is order result by descending

$result=mysql_query($sql) or die (mysql_error());
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
          <li class="active"><a href="adminhome.php">Home</a></li>
          <li><a href="messages.php">Messages</a></li>
          <li><a href="forum_mainforum.php">Forums</a></li>
          <li><a href="#">Chatrooms</a></li>
          <li><a href="adminmanageusers.php">Manage Users</a></li>
          <li><a href="adminforumreq.php">Manage Forums</a></li>
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
        <h1>Welcome <?php echo  $_SESSION['fullname'];?>!</h1>
        <p>As the admin you can manage users and forums.</p>
        <p><a class="btn btn-primary btn-lg" href="forum_mainforum.php" role="button">View Forums</a></p>
      </div>
    </div>

  </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    </html>
</html>


<?php
}else{
  header("location: index.php");
}


ob_end_flush();
?>
