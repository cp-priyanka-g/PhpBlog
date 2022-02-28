<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'myblog');
if ($db->connect_error) {
die("Connection failed: " . $db->connect_error);
}
if(count($_POST)>0) {
mysqli_query($db,"UPDATE view_post set view_status='" . $_POST['view_status'] . "' WHERE user_id='" . $_POST['userid'] . "'");
$message = "Record Modified Successfully";
}
$result = mysqli_query($db,"SELECT * FROM view_post WHERE user_id='" . $_GET['id'] . "'");
$row= mysqli_fetch_array($result);
?>
<html>
<head>
<title>Update User Data</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>

Username: <br>
<input type="hidden" name="userid" class="txtField" value="<?php echo $row['user_id']; ?>">
<input type="text" name="userid"  value="<?php echo $row['user_id']; ?>">
<br>
View post: <br>

<select name="view_status" >
  <option value="<?php echo $row['view_status']; ?>">"<?php echo $row['view_status']; ?>"</option>
  <option value="Active">Active</option>
  <option value="Inactive">InActive</option>
  </select>

<input type="submit" name="submit" value="Submit" class="button">
<a href="adminHome.php">BACK</a>

</form>
</body>
</html>


