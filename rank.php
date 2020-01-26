<?php
ob_start();
session_start();
require_once 'config.php';

$id =  $_POST['id'];

mysql_query("UPDATE thread SET rank = rank + 1  where threadno = '$id'");

?>
