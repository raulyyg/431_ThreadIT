<?php
ob_start();
session_start();
require_once 'config.php';

 // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['user'])!="" ) {
  header("Location: userhome.php");
  exit;
 }

 $error = false;

 if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
  $uname = trim($_POST['uname']);
  $uname = strip_tags($uname);
  $uname = htmlspecialchars($uname);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs

  if(empty($uname)){
   $error = true;
   $unameError = "Please enter your username.";
  }

  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }

  // if there's no error, continue to login
  if (!$error) {

   //$password = hash('sha256', $pass); // password hashing using SHA256

   $res=mysql_query("SELECT fullname, username FROM users WHERE username='$uname' AND password='$pass' AND status= 'admin'");

   $row=mysql_fetch_array($res);
   $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

   if( $count == 1 ) {
    $_SESSION['user'] = $row['username'];
       $_SESSION['fullname'] = $row['fullname'];
    header("Location: adminhome.php");
   } else {
    $errMSG = "You do not have administrator credentials. Please contact the administrator.";
   }

  }

 }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Thread It | CPSC 431 Spring 2017 Final Project </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>

  <div class="container">
  	<div class="row">
      <h1>Welcome ThreadIt Administrator!</h1>
        <i>Please enter your credentials.</i>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <div class="col-md-12">
            <?php
              if ( isset($errMSG) ) {
            ?>
            <div class="form-group">
             <div class="alert alert-danger">
               <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
              </div>
            </div>
            <?php
              }
            ?>
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="uname" name="uname" class="form-control" placeholder="Your Username" value="<?php echo $uname; ?>" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $unameError; ?></span>
            </div>

            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>

            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>
        </div>

    </form>
    </div>
</div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</html>
<?php ob_end_flush(); ?>
