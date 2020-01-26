<?php

//this will avoid mysql_connect deprecation error
error_reporting( ~E_DEPRECATED & ~E_NOTICE );


define('DBHOST' , 'localhost');
define('DBUSER' , 'root');
define('DBPASS' , '');
define('DBNAME' , 'project');

$conn = mysql_connect('ecsmysql', 'cs431s5', 'eiquooki');

$dbcon = mysql_select_db("cs431s5", $conn);

if(!$conn)
{
    die("Connection failed : " . mysql_error());
}

if (!$dbcon)
{
    die("Database Connection failed : " . mysql_error());
}

?>
