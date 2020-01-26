<?php
ob_start();
session_start();
require_once 'config.php';


$tbl_name="post"; // Table name

 //echo "Cool";
// get data that sent from form
$postno = $_POST['postno'];
$forumname=$_POST['forumname'];
$threadno = $_POST['threadno'];
$text=$_POST['text'];

//$picture = $_POST['picture'];



 //echo "RAWR";
 //echo $forumname;
$datetime=date("d/m/y h:i:s"); //create date time

$sql="INSERT INTO $tbl_name(postno, forumname ,threadno, text, postuploadtime) VALUES('$postno', '$forumname', '$threadno', '$text' , '$datetime')";
echo $sql;
$result=mysql_query($sql);
echo $result;
 //echo "what?";
if($result){
echo "Successful<BR>";
echo "<a href=main_forum.php>View threads</a>";
}
else {
echo "ERROR";
}
mysql_close();
?>

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
             <body>
                  </body


            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

 <div id="wrapper">

 <div class="container">

</body>
</html>
