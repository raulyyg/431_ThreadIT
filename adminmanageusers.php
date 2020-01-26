<?php
require_once 'config.php';
ob_start();
session_start();

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
    <!--Display Current Users-->
    <div class="container">
      <div class="row">
        <div class="col">
          <h2>Manage ThreadIt Users
          <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addusermodal">Add a User</button>
          </h2>
        </div>
        <!-- Modal content-->
        <div id="addusermodal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add a User</h4>
              </div>
              <div class="modal-body">
                <!--Start Form-->
                <form method="post" action="adminmanageusers.php">
                        <div class="form-group">
                         <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="fullname" class="form-control" placeholder="Enter Name" maxlength="50"  />
                        </div>
                            <span class="text-danger"><?php echo $userfullnameError; ?></span>
                        </div>

                        <div class="form-group">
                         <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="username" name="username" class="form-control" placeholder="Enter Your Username" maxlength="40" />
                        </div>
                            <span class="text-danger"><?php echo $usernameError; ?></span>
                        </div>

                        <div class="form-group">
                         <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" maxlength="15" />
                        </div>
                            <span class="text-danger"><?php echo $passwordError; ?></span>
                        </div>
                        <div class="form-group">
                         <input type="submit" class="btn btn-block btn-primary" name="btn-add" id="btn-add" value="Add User">
                       </div>
                </form>
                <?php
                //Add new user
                if( isset($_POST['btn-add']) )
                {
                //clean user inputs to prevent problems
                $userfullname = trim($_POST['fullname']);
                $userfullname = strip_tags($userfullname);
                $userfullname = htmlspecialchars($userfullname);

                $username = trim($_POST['username']);
                $username = strip_tags($username);
                $username = htmlspecialchars($username);

                $password = trim($_POST['password']);
                $password = strip_tags($password);
                $password = htmlspecialchars($password);

                // basic name validation
                  if (empty($userfullname)) {
                   $error = true;
                   $userfullnameError = "Please enter your full name.";
                  } else if (strlen($userfullname) < 3) {
                   $error = true;
                   $userfullnameError = "Name must have atleat 3 characters.";
                  } else if (!preg_match("/^[a-zA-Z ]+$/",$userfullname)) {
                   $error = true;
                   $userfullnameError = "Name must contain alphabets and space.";
                  }

                  //basic username validation
                  if (empty($username)) {
                      $error = true;
                      $usernameError = "Please enter a valid username.";
                  }else {
                   // check if username exist or not
                   $query = "SELECT username FROM users WHERE username='$username'";
                   $result = mysql_query($query);
                   $count = mysql_num_rows($result);
                   if($count!=0){
                    $error = true;
                    $usernameError = "Provided username is already in use.";
                   }
                  }
                  // password validation
                  if (empty($password)){
                   $error = true;
                   $passwordError = "Please enter password.";
                  } else if(strlen($password) < 4) {
                   $error = true;
                   $passwordError = "Password must have atleast 4 characters.";
                  }

                    //password encrypt
                //$password = hash('sha256' , $pass);

                //if there is no error, continue to signup
                if (!$error)
                {
                    $query = "INSERT INTO users(fullname, username, password) VALUES('$userfullname' , '$username' , '$password')";
                    $res = mysql_query($query);

                    if($res) {
                        $errTyp = "Success";
                        $errMSG = "Successfully registered, you may log in now.";
                        header("location: adminmanageusers.php");
                    } else {
                        $errTyp = "Danger";
                        $errMSG = "Something went wrong, please try again later...";
                    }
                }

                }

                 ?>
                <!--End Form-->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
      </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Username</th>
            <th>Status</th>
            <th>Set As Moderator</th>
            <th>Ban a User</th>
          </tr>
        </thead>
        <tbody>
    <?php
    // Start looping table row
        $rows = mysql_fetch_array($result);
        while($rows) {
    ?>
        <tr>
          <td><?php echo $rows['fullname']; ?></td>
          <td><?php echo $rows['username']; ?></td>
          <td><?php echo $rows['status']; ?></td>
          <td><a href="moderator.php?username=<?php echo $rows['username'];?>">Set as Moderator</a></td>
          <td><a href="ban.php?username=<?php echo $rows['username'];?>">Ban</a></td>
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

  </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    </html>
</html>


<?php ob_end_flush(); ?>
