<?php
ob_start();
session_start();
require_once 'config.php';

//if session is not set this will redirect to login page
if(!isset($_SESSION['user']) ) {
header("Location: index.php");
exit;
}

$postno = $_GET['removepost'];

echo "Check point 1";
echo $postno;


mysql_query("DELETE from post WHERE postno=$postno");

header("Location: view_topic.php?threadno=<?php echo $threadno ?>&forumname=<?php echo $forumname;");



?>




