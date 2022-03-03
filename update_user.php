<?php
session_start();

if (!isset($_SESSION["user"])) {
    $_SESSION["msg"] = "You must log in first";
    header("location: login.php");
}
include "connection.php";

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$result = mysqli_query($db, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
 <head>
   <title> Retrive data</title>
   <link rel="stylesheet" href="style.css">
 </head>
<body>
<?php if (mysqli_num_rows($result) > 0) { ?>
<table>
	  <tr>
	    <td>User_id</td>
		<td>UserName</td>
		<td>Email</td>
		<td>User_Type</td>
		<td>Status</td>
		<td>Action</td>
	  </tr>
			<?php
   $i = 0;
   while ($row = mysqli_fetch_array($result)) { ?>
	  <tr>
	    <td><?php echo $row["id"]; ?></td>
		<td><?php echo $row["username"]; ?></td>
		<td><?php echo $row["email"]; ?></td>
		<td><?php echo $row["ustatus"]; ?></td>
		<td><?php echo $row["user_type"]; ?></td>
		<td><a href="update-process.php?id=<?php echo $row["id"]; ?>">Update</a></td>
      </tr>
			<?php $i++;}
   ?>
</table>
 <?php } else {echo "No result found";} ?>
 </body>
</html>