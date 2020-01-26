<?php
ob_start();
session_start();
require_once 'config.php';
////if session is not set this will redirect to login page
//if(!isset($_SESSION['user']) ) {
//header("Location: projectlogin.php");
//exit;
//}


//create a new thread
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
                        <li><a href="messages.php">Messages</li>
                        <li class="divider"></li>
                        <li><a href="projectlogout.php">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    </ul>
                </li>
          </ul>
      </div>
    </nav>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form id="form1" name="form1" method="post" action="add_new_topic.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" bgcolor="#E6E6E6"><strong>Create A New Thread</strong> </td>
</tr>
<tr>
<td width="14%"><strong>Forum Name</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="forumname" type="text" id="forumname" size="50" value="<?php echo $_GET['forumname']?>" /></td>
</tr>
<?php echo $_GET['forumname']?>
</tr>
<tr>
<td width="14%"><strong>Thread No</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="threadno" type="text" id="threadno" size="50" /></td>
</tr>
<tr>
<td width="14%"><strong>Title of Thread</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="title" type="text" id="title" size="50" /></td>
</tr>
<tr>
<td width="14%"><strong>Status</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="status" type="text" id="status" size="50" /></td>
</tr>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit" /> <input type="reset" name="Submit2" value="Reset" /></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

</body>
</html>
