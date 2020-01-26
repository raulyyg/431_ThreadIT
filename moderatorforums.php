<?php
require_once 'config.php';
ob_start();
session_start();

$username = $_SESSION['user'];

//Selects all Forums
$sql="SELECT * FROM forum WHERE moderator = '$username' ORDER BY forumname";
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
    <!--Display Forum Requests-->
    <div class="container">
      <div class = "row">
        <div class="col">
          <h2>Manage Forums
            <a type="button" class="btn btn-success btn-lg" href="new_forum.php">New Forum</a>
          </h2>
        </div>
      </div>
      <div class=row>
      <table class="table">
        <thead>
          <tr>
            <th>Forum Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Picture</th>
            <th>Moderator</th>
          </tr>
        </thead>
        <tbody>
    <?php
    // Start looping table row
        $rows = mysql_fetch_array($result);
        while($rows) {
    ?>
        <tr>
          <td><?php echo $rows['forumname']; ?></td>
          <td><?php echo $rows['description']; ?></td>
          <td><?php echo $rows['status']; ?></td>
          <td><img src ="<?php echo $rows['picture'];?>" class="img-thumbnail"></a></td>
          <td><?php echo $rows['moderator']; ?></td>
          <td><a href="adminapproveforum.php?forumname=<?php echo $rows['forumname'];?>">Edit Details</a></td>
          <td><a href="admindisproveforum.php?forumname=<?php echo $rows['forumname'];?>">Edit Threads</a></td>
        </tr>
    <?php
      $rows = mysql_fetch_array($result);
    // Exit looping and close connection
    }
    mysql_close();
    ?>
    </tbody>
  </table>
</div>
</div>

  </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    </html>
</html>


<?php ob_end_flush(); ?>
