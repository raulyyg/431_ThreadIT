<?php
ob_start();
session_start();
require_once 'config.php';

if(!isset($_SESSION['user']) ) {
header("Location: index.php");
exit;
}


$forumname = $_GET['forumname'];
$startuser = $_SESSION['user'];


$sql="SELECT * FROM thread WHERE forumname = '$forumname' ORDER BY threadno DESC";


$result=mysql_query($sql) or die (mysql_error());

//-----END DISPLAY of THREADS QUERY--------
if( isset($_POST['btn-add-thread']))
{


  //Insert form into table
  $tbl_name="thread"; // Table name
  $threadforumname = $_GET['forumname'];
  $title=$_POST['title'];
  $status = "open";
  $startuser = $_SESSION['user'];

    //$today = date("F j, Y, g:i a");
  $datetime= date("d/m/y h:i:s"); //create date time
  //var_dump($threadforumname);
  //die();

  $isql="INSERT INTO $tbl_name(forumname , title, status, threaduploadtime, startuser) VALUES('$threadforumname', '$title' , '$status' , now(), '$startuser')";
  $iresult=mysql_query($isql) or die (mysql_error());

  if($iresult)
    {
      ?>
      <div class="alert alert-success">
      <strong>Success!</strong>
      </div>
      <?php
    }
  else{
      mysql_error($iresult);
  }
}
?>

<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Welcome <?php echo  $_SESSION['fullname'];?></title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/styles.css">
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
<div class="container">
  <div class="row">
    <h1>
      <?php echo $forumname  ?> Threads
    </h1>
      <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#addthread">Add Thread</button>
      <a type="button" class="btn btn-info" href="forum_mainforum.php">Back to Forums</a>

      <div id="addthread" class="collapse">
        <form class="form-inline" method="post" action="main_forum.php?forumname=<?php echo $forumname;?>">
          <div class="form-group">
            <label>Forum: </label>
              <input name="forumname" id="forumname" value="<?php echo $forumname?>" type="text">
          </div>
          <div class="form-group">
            <label>Title of Thread:</label>
            <input name="title" type="text" id="title">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary" name="btn-add-thread">Add</button>
          </div>
        </forum>
      </div>
    </h1>
  </div>
  <ul class="list-group">
<?php

// Start looping table row
$rows = mysql_fetch_array($result);
while($rows) {
  $thisthread = $rows['threadno'];
  $csql = mysql_query("SELECT * from post WHERE threadno = '$thisthread'");
  $countquery = mysql_num_rows($csql);

?>
<li class="list-group-item">
  <h5><a href="view_topic.php?threadno=<?php echo $rows['threadno']; ?>&forumname=<?php echo $rows['forumname']; ?>"><?php echo $rows['title']; ?></a>
  </h5>
  <span class="badge badge-default badge-pill">number of posts: <?php echo $countquery ?></span>
  <small><b>started by:</b> <em><?php echo $rows['startuser']; ?></em> <strong>added:</strong> <?php echo $rows['threaduploadtime']; ?> </small>
  <p>
    Rank:
    <button type="button" class="btn btn-default btn-sm" name="rankup" id="<?php echo $rows['threadno']; ?>" value="<?php echo $rows['rank']; ?>">
      <span id="rank_<?php echo $rows['threadno']; ?>" value="<?php echo $rows['rank']; ?>"><?php echo $rows['rank']; ?></span>
      <span class="glyphicon glyphicon-thumbs-up" id="thumbsup"></span>
    </button>
    <!--<button type="button" class="btn btn-default btn-sm" name ="rankdown" id="<?php echo $rows['threadno']; ?>">
      <span class="glyphicon glyphicon-thumbs-down" id="thumbsdown"></span>
    </button>-->
  </p>
</li>

<?php


$rows = mysql_fetch_array($result);

// Exit looping and close connection
}

mysql_close();
?>

</div>
  <script src="./js/main.js"></script>
</body>
</html>
