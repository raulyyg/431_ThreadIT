<?php

ob_start();
session_start();
if(isset($_SESSION['user']) != "" )
{
header("Location: index.php");
}
include_once 'config.php';

$error = false;

if( isset($_POST['btn-signup']) )
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
        unset($userfullname);
        unset($username);
        unset($password);
    } else {
        $errTyp = "Danger";
        $errMSG = "Something went wrong, please try again later...";
    }
}

}



?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign Up </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css">
</head>

<body>

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

     <div class="col-md-12">

         <div class="form-group">
             <h2 class="">Sign Up</h2>
            </div>

         <div class="form-group">
             <hr />
            </div>

            <?php
   if ( isset($errMSG) ) {

    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>

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
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>

            <div class="form-group">
             <a href="index.php">Sign in Here...</a>
            </div>

        </div>

    </form>
    </div>

</div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</html>
</html>
<?php ob_end_flush(); ?>
