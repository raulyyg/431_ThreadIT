<?php
session_start();
?>

<!
DOCTYPE html>
<html>
<head>

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
        <a class="navbar-brand" href="userhome.php">ThreadIt</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="userhome.php">Home</a></li>
        <li><a href="messages.php">Messages</a></li>
        <li><a href="welcomeChat.php">Chatrooms</a></li>
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

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width = device-width, initial-scale = 1">
<title>CHATROOM</title>
<link rel= "stylesheet" type= "text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


</head>
<body>
<style>
body {
    background-color: #FEFEFE;
}
h1 {
    color: black;
    text-align: center;
}
</style>

<div class="container">
 
<!-- page-header adds space aroundtext and enlarges it. It also adds an underline at the end -->
<div class="page-header">
<h1>431 Chat Room</h1>
</div>


<?php
//session_start();
require_once('config.php');
//	echo		$_SESSION['email'];
//	echo	$_SESSION['password'];
    echo "WELCOME: ";
echo	$_SESSION['fullname']; //<--- This might be changed to fullname
//echo $_SESSION['time'];
				
//CHATROOM!
$user = $_SESSION['user'];
?>

    
<script type="text/javascript">
// jQuery CORS example
$.ajax({
    xhrFields: {
        withCredentials: true
    },
    type: "GET",
    url: "http://www.example.org/ajax.php"
}).done(function (data) {
    console.log(data);
});

// XMLHttpRequest
var xhr = new XMLHttpRequest();
xhr.open("GET", "http://www.example.org/ajax.php", true);
xhr.withCredentials = true;
xhr.onload = function () {
    console.log(xhr.responseText);
};
xhr.send();
</script>
    
    
    
<script>    
function getText() {
		
	var $a =	document.getElementById('text').value;
	
		xhr = new XMLHttpRequest();
		xhr.open('POST' , 'config.php',true);
		xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
		xhr.send('chatroom='+$a);
		xhr.onreadystatechange=function(){
			if (xhr.responseText){
			//	document.getElementById('chatarea').innerHTML=xhr.responseText;
									}
				}
					}
		

function setText(){
	
	xhr = new XMLHttpRequest();
	xhr.open('POST' , 'chatFetch.php' , true);
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	xhr.send();
	xhr.onreadystatechange = function(){
	//	alert(xhr.responseText);
			document.getElementById('chatarea').innerHTML = xhr.responseText;
			}
		
	}
	setInterval("setText()",2000);
	
	
setInterval("users()",3000);

	
	function users(){
	xhr1 = new XMLHttpRequest();
	xhr1.open('POST' , 'userFetch.php' , true);
	xhr1.setRequestHeader('content-type','application/x-www-form-urlencoded');
	xhr1.send();
	xhr1.onreadystatechange = function(){
	//	alert(xhr.responseText);
			document.getElementById('loginperson').innerHTML = xhr1.responseText;
			}
		
		
		}
		
		
</script>




<form action="userhome.php" method="post">
<button type="submit" class = "btn-primary btn-sm" role = "button">GO BACK</button>

    
</form>
<div id="chatbox">
<div id ="chatarea">
</div>
<h><center>ONLINE USERS</center></h>
<div id="loginperson">
</div>

<div id="textbox">
<form>
<textarea rows="4" cols="90" id="text"></textarea>
<input type="submit" value="Send" onclick="getText()" />
</form>
</div></center>

</div>




<style>

#chatbox
{		
			
			background: #F3F2F3;
			border:hidden;
			height:500px;
			width:1000px;
			align;
			}
			#chatarea {
				width:750px;
				height:400px;
				border:hidden;
				float:left;
				overflow:auto;

				}
				#loginperson {
					background: #E9E8E8;
					width:238px;
					height:479px;
					border:hidden;
					float:right;}
					#textbox {
						background-color: orange;
						width:656px;
						height:89px;
						border:hidden;
						float:left;
						}
						#chatting {
							float:left;}
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- Use downloaded version of Bootstrap -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
 









 
 
