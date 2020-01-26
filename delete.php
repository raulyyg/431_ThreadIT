<?php
ob_start();
session_start();
require_once 'config.php';

//if session is not set this will redirect to login page
if(!isset($_SESSION['user']) ) {
header("Location: index.php");
exit;
}

$messageid = $_GET['delete'];

echo "Check point 1";
echo $messageid;


mysql_query("DELETE from mailbox WHERE MessageID=$messageid");

header("Location: messages.php");


?>




