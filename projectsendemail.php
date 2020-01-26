<?php
session_start();
require_once 'config.php';

if(!isset($_SESSION['user']) ) {
header("Location: index.php");
exit;
}
?>


<!DOCTYPE html>
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
  <body>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">ThreadIt</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="adminhome.php">Home</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="forum_mainforum.php">Forums</a></li>
            <li><a href="#">Chatrooms</a></li>
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
        <h1>Send a Message</h1>
      </div>
    <div class="row">
        <!--            Display the form-->
        <form action="projectsendemail.php" method="post">
            Please fill the following form to send a message.<br />
            <div class="form-group">
              <label for="receiver">To: </label>
              <input type="text" class="form-control" id="receiver" name="receiver" placeholder="Enter receiver's ThreadIt username" required>
            </div>
            <div class="form-group">
              <label for="title">Subject</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter Subject">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea cols="80" rows="8"class="form-control" id="message" name="message"  placeholder="Enter your message here..." required></textarea>
            </div>
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-send">Send</button>
            </div>
        </form>
    </div>
<?php
    //We check if the form has been sent

    if(isset($_POST['btn-send']))
    {
        $otitle = $_POST['title'];
        $orecip = $_POST['receiver'];
        $omessage = $_POST['message'];

        //We check if all the fields are filled
        if($_POST['title']!='' and $_POST['receiver']!='' and $_POST['message']!='')
        {
            $dn1 = mysql_num_rows(mysql_query('SELECT username FROM users WHERE username="'.$orecip.'"'));
            if($dn1 > 0)
            {
                $lastMessageId = mysql_num_rows(mysql_query('SELECT * FROM mailbox'));

                $lastMessageId = $lastMessageId + 1;

                $MsgTime = new DateTime('NOW');
                 //We send the message
                $username = $_SESSION['user'];
                $query = "INSERT into mailbox (MessageID, Subject,  sender, receiver, MsgTime, MsgText, status) values('$lastMessageId', '$otitle', '$username', '$orecip', now(), '$omessage', 0)";
                $req = mysql_query($query) or die(mysql_error());

                if($req){
                  echo 'Success insert!';

                }
                else {
                    $error = 'The recipient does not exists.';
                    echo 'Error saving email.';
                }
            }
          }
        }
            ?>
          </div>
            <div class="foot"><a href="messages.php">Go to my Personal messages</a>
            </div>
        </body>
</html>
