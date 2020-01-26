<?php
ob_start();
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
    <div class="col-sm-3 col-md-2 sidebar">
      <a class="btn btn-primary" href="projectsendemail.php" role="button">New Message</a>
      <ul class="nav nav-sidebar nav-tabs">
        <li class="active">
          <a href="#inbox" data-toggle="tab"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right">2</span></a>
        </li>
        <li>
          <a href="#sent" data-toggle="tab"><i class="fa fa-envelope-o"></i> Sent Mail</a>
        </li>
        <li>
          <a href="#trash" data-toggle="tab"><i class=" fa fa-trash-o"></i> Trash</a>
        </li>
      </ul>
    </div>
    <div class="col-sm-9 main">
      <div class="tab-content clearfix">
        <div class="tab-pane active" id="inbox">
          <h1 class="page-header">INBOX</h1>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>From </th>
                <th>Subject</th>
                <th>Message</th>
                <th>Received</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
  <?php

$mailboxresult=mysql_query("SELECT MessageID, Subject, MsgTime, MsgText, sender, receiver, status FROM mailbox WHERE receiver = '$user' ORDER BY MsgTime DESC");

//echo "result: " + $mailboxresult;
if($mailboxresult === FALSE) {
    die(mysql_error()); // TODO: better error handling

}
while ($userRow=mysql_fetch_array($mailboxresult, MYSQL_NUM))
{
?>
    <tr class="table-row">
      <td><?php echo $userRow[4];?></td>
      <td><?php echo $userRow[1];?></td>
      <td><?php echo $userRow[3];?></td>
      <td><?php echo date('M d, y g:i a',strtotime($userRow[2]));?></td>
      <td>Delete</td>
    </tr>
    </a>


  <?php
} //end looping
   ?>
  </table>
</div>
  <div class="tab-pane" id="sent">
    <h1 class="page-header">SENT</h1>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>To </th>
          <th>Subject</th>
          <th>Message</th>
          <th>Sent</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
  <?php

$mailboxTworesult=mysql_query("SELECT MessageID, Subject, MsgTime, MsgText, sender, receiver, status FROM mailbox WHERE sender = '$user' ORDER BY MsgTime DESC");

//echo "result: " + $mailboxresult;
if($mailboxTworesult === FALSE) {
    die(mysql_error()); // TODO: better error handling

}
while ($sentRow=mysql_fetch_array($mailboxTworesult, MYSQL_NUM))
{
  ?>
  <tr class="table-row">
    <td><?php echo $sentRow[5]?></td>
    <td><?php echo $sentRow[1]?></td>
    <td><?php echo $sentRow[3]?></td>
    <td><?php echo date('M d, y g:i a',strtotime($sentRow[2]));?></td>
    <td>Delete</td>
  </tr>
  </a>
  <?php
}

      ?>

      </table>
    </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
<?php ob_end_flush(); ?>
