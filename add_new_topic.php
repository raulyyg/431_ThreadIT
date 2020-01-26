<?php
ob_start();
session_start();
require_once 'config.php';


$tbl_name="thread"; // Table name

 //echo "Cool";
// get data that sent from form

$forumname=$_GET['forumname'];
$threadno = $_POST['threadno'];
$title=$_POST['title'];
$status = $_POST['status'];

//$picture = $_POST['picture'];



 //echo "RAWR";
 //echo $forumname;

//$today = date("F j, Y, g:i a");
$datetime= date("d/m/y h:i:s"); //create date time

$sql="INSERT INTO $tbl_name(forumname ,threadno, title, status, threaduploadtime) VALUES('$forumname', '$threadno', '$title' , '$status' , now())";
echo $sql;
$result=mysql_query($sql);
echo $result;
 //echo "what?";
if($result){
echo "Successful<BR>";
echo $datetime;
?>


<a href="main_forum.php?forumname=<?php echo $forumname?>"><?php echo $forumname?></a>

<?php
}
else {
echo "ERROR";
}
mysql_close();
?>

<!DOCTYPE html>

<html>
<body>
 <div class="page-header">
     <h1>Image </h1>
     </div>

        <div class="row">
        <div class="col-lg-12">
        </div>
        </div>
 <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header"></div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav"></ul>
          <ul class="nav navbar-nav navbar-right">

            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

 <div id="wrapper">

 <div class="container">

</body>
</html>
