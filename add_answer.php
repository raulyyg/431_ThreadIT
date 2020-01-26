<?php
ob_start();
session_start();
require_once 'config.php';


$tbl_name="post"; // Table name


// Get value of id that sent from hidden field
$id=$_POST['postno'];

// Find highest answer number.
$sql="SELECT MAX(postno) AS Maxpost_no FROM $tbl_name WHERE threadno='$threaedno'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);

// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1
if ($rows) {
$Max_id = $rows['Maxpost_no']+1;
}
else {
$Max_id = 1;
}

// get values that sent from form

$text=$_POST['text'];
$datetime=date("d/m/y H:i:s"); // create date and time



// Insert answer
$sql2="INSERT INTO $tbl_name(threadno, postno, text, datetime, threadno, forumname)VALUES('$threadno', '$Max_id', '$text', '$datetime', '$threadno', '$forumname')";
$result2=mysql_query($sql2);

if($result2){
echo "Successful<BR>";
echo "<a href='view_topic.php?id=".$id."'>View your answer</a>";

// If added new answer, add value +1 in reply column
$tbl_name2="fquestions";
$sql3="UPDATE $tbl_name2 SET reply='$Max_id' WHERE postno='$postno'";
$result3=mysql_query($sql3);
}
else {
echo "ERROR";
}

// Close connection
mysql_close();
?>
