<?php
ob_start();
session_start();
require_once 'config.php';

if(!isset($_SESSION['user']) ) {
header("Location: index.php");
exit;
}
$poster = $_SESSION['user'];

$threadno = $_GET['threadno'];
$forumname = $_GET['forumname'];

$title = $_GET['title'];
$datetime = $_GET['postuploadtime'];
$status = open;


$sql="SELECT * FROM post WHERE threadno = '$threadno' AND forumname = '$forumname' ORDER BY postno";
//get thread title DESC JOIN thread on post.threadno = thread.threadno
$result=mysql_query($sql) or die (mysql_error());
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
          <a class="navbar-brand" href="index.php">ThreadIt</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="userhome.php">Home</a></li>
          <li><a href="messages.php">Messages</a></li>
          <li><a href="#">Chatrooms</a></li>
          <li><a href="forum_mainforum.php">Forums</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong><?php echo  $_SESSION['fullname'];?></strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="projecthome.php">Messages</li>
                        <li class="divider"></li>
                        <li><a href="projectlogout.php">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    </ul>
                </li>
          </ul>
      </div>
    </nav>
<div class="container">
  <h1><?php echo $title; ?> Posts</h1>
    <ul class="list-group">

<?php

// Start looping table row
$rows = mysql_fetch_array($result);


while($rows) {
  $editPostid = $rows['postno'];
 ?>
<li class="list-group-item">
    <div class="justify-content-between">
      <h5>RE: <?php echo $rows['threadno'];?></h5>
      <p> <?php echo $rows['text']; ?></p>
    </div>
    <small>by: <em><?php echo $rows['poster']; ?></em></small>
    <small>posted: <?php echo $rows['postuploadtime']; ?></small>
    <?php
      if($rows['poster']==$_SESSION[user]){
     ?>
    <button type="button" class="btn btn-sm btn-default" data-toggle="collapse" data-target="#editpost_<?php echo $editPostid; ?>">Edit Post</button>
    <div id="editpost_<?php echo $editPostid; ?>" class="collapse">
      <form method="post" action="view_topic.php?threadno=<?php echo $threadno ?>&forumname=<?php echo $forumname; ?>">
      <input type="text" id="postno" name="postno" value="<?php echo $rows['postno']; ?>">
        <div class="form-group">
          <textarea class="form-control" name="edittextpost" id="edittextpost" col="80" row="5"><?php echo $rows['text'];?></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-sm btn-default" name="btn-edit-post">Submit Edits</button>
        </div>
      </forum>
    </div>
    <?php
    }

     ?>
</li>

<?php

$rows = mysql_fetch_array($result);

// Exit looping and close connection
}

//-----------EDIT A POST--------------
//If form is completed
if( isset($_POST['btn-edit-post'])){
        $tbl_name="post"; // Table name
        $forumname=$_GET['forumname'];
 	      $postno=$_POST['postno'];
        $threadno = $_GET['threadno'];

        echo $postno;

        $text=mysql_real_escape_string($_POST['edittextpost']);
        $poster = $_SESSION['user'];

        $sql="UPDATE $tbl_name SET postuploadtime = now(), text = '$text' WHERE postno = '$postno'";

        $result=mysql_query($sql) or die (mysql_error());
        if($result){

        ?>
        <a href="view_topic.php?threadno=<?php echo $threadno; ?>&forumname=<?php echo $forumname; ?>">Refresh Page to See Changes</a>
        <?php
        }
        else {
        echo "ERROR";
        }
}



//-----------New Post--------------
//If form is completed
if( isset($_POST['btn-add-post'])){
        $tbl_name="post"; // Table name
        $forumname=$_GET['forumname'];
        $threadno = $_GET['threadno'];
        $text=mysql_real_escape_string($_POST['textpost']);
        $poster = $_SESSION['user'];
        //var_dump($text);


        //$picture = $_POST['picture'];



         //echo "RAWR";
         //echo $forumname;
      //  $datetime=date("d/m/y h:i:s"); //create date time

        $sql="INSERT INTO $tbl_name(postno, text, postuploadtime, forumname, threadno, poster) VALUES(0, '$text', now(), '$forumname', '$threadno', '$poster')";
        //var_dump($sql);
        //echo $sql;
        $result=mysql_query($sql) or die (mysql_error());
        //echo $result;
         //echo "what?";
        if($result){
          ?>
          <a href="view_topic.php?threadno=<?php echo $threadno; ?>&forumname=<?php echo $forumname; ?>">Refresh Page to See Changes</a>
          <?php
        }
        else {
        echo "ERROR";
        }
}


mysql_close();
?>

<br> <br>


<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#addpost">New Post</button>
<a type="button" class="btn btn-info" href="main_forum.php?forumname=<?php echo $forumname; ?>">Back</a>

<div id="addpost" class="collapse">
  <form method="post" action="view_topic.php?threadno=<?php echo $threadno ?>&forumname=<?php echo $forumname; ?>">
    <div class="form-group">
      <textarea class="form-control" name="textpost" id="textpost" col="80" row="5"><?php echo $text;?></textarea>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="btn-add-post">Submit New Post</button>
    </div>
  </forum>
</div>


</body>
</html>
