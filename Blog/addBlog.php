<?php include('adminPanel.php'); ?>
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

<form method="post" enctype="multipart/form-data">


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
