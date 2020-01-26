<?php
ob_start();
session_start();
require_once 'config.php';


//variables to be inserted
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$forumname=$_POST['forumname'];
$description = $_POST['description'];
$status = "request";
$moderator = $_SESSION['user'];

$picture = $target_file;

//$fileToUpload = $target_file;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql = mysql_query("INSERT into forum(forumname, description, status, moderator, picture) values ('$forumname','$description','$status','$moderator', '$picture')",$conn);
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            echo "<a href = forum_mainforum.php>View Forums</a>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
  }
}
 ?>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form action="new_forum.php" method="post" enctype="multipart/form-data">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" bgcolor="#E6E6E6"><strong>Create A New Forum</strong> </td>
</tr>
<tr>
<td width="14%"><strong>Forum Name</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="forumname" type="text" id="forumname" size="50" /></td>
</tr>
<tr>
<td width="14%"><strong>Description</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="description" type="text" id="description" size="50" /></td>
</tr>
<tr>
<td width="14%"><strong>Image to Upload</strong></td>
<td width="2%">:</td>
<td width="84%"><input type="file" name="fileToUpload" id="fileToUpload">
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="submit" value="submit" /> <input type="reset" name="Submit2" value="Reset" /></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
