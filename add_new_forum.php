<?php
ob_start();
session_start();
require_once 'config.php';


$tbl_name="forum"; // Table name

 //echo "Cool";


//$picture = $_POST['picture'];
//variables to be inserted
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// get data that sent from form
$forumname=$_POST['forumname'];
$description = $_POST['description'];
$status = $_POST['status'];
$moderator = $_SESSION['username'];
$picture = $target_file;

// Check if image file is a actual image or fake image

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
        $sql="INSERT INTO $tbl_name(forumname, description, status, picture, moderator) VALUES('$forumname', '$description', '$status', '$picture' ,'$moderator')";
        $result=mysql_query($sql);
        echo "Successful<BR>";
        echo "<a href=forum_mainforum.php>View forums</a>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
  }


//end post picture



 //echo "RAWR";
 //echo $forumname;
 //$datetime=date("d/m/y h:i:s"); //create date time


echo $sql;

echo $result;
 //echo "what?";

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
