<?php
session_start();
if (!isset($_SESSION["user"])) {
    $_SESSION["msg"] = "You must log in first";
    header("location: login.php");
}

if (isset($_POST["post_btn"])) {
    include "connection.php";

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $title = $_POST["title"];
    $desc = $_POST["description"];
    $create_date = $_POST["create_date"];
    $author = $_POST["author"];
    $category = $_POST["category"];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (
            move_uploaded_file(
                $_FILES["fileToUpload"]["tmp_name"],
                $target_file
            )
        ) {
            echo "The file " .
                htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) .
                "by" .
                $name .
                " has been uploaded.";
            $blog_img = $_FILES["fileToUpload"]["name"];

            $query = "INSERT INTO posts (title,descriptionbox,created_date,author,category,featureimage)VALUES('$title', '$desc', '$create_date','$author','$category','$blog_img')";
            mysqli_query($db, $query);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    die($query);
    $db->close();
    header("location: adminHome.php");
}
?>

<!DOCTYPE html>

<html>
<head>
	<title>Admin Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Add Blog</h2>
</div>

<form action="adminPanel.php" method="post" enctype="multipart/form-data">


<div>
    <label>Title</label>
    <input type="text" name="title">
</div>
<div>
    <label>Description</label>
    <input type="text" name="description">
</div>
<div>
    <label>Created_date</label>
    <input type="date" name="create_date">
    
</div>
<div>
<label>Author</label>
<input type="text" name="author" >
</div>

<div>
<label>Category</label>
<input type="text" name="category" >
</div>
<div>

<label>Select image to upload:</label>
  <input type="file" name="fileToUpload" id="fileToUpload">
</div>

<div>
    <button type="submit" class="btn" name="post_btn"> Publish</button>
</div>
</form>
<a href="adminHome.php">BACK</a>
	
</body>
</html>
