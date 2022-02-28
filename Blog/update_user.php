<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'myblog');
    if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

$result = mysqli_query($db,"SELECT * FROM users");

?>
<!DOCTYPE html>
<html>
 <head>
   <title> Retrive data</title>
   <link rel="stylesheet" href="style.css">
 </head>
<body>
<?php
if (mysqli_num_rows($result) > 0) {
?>
<table>
	  <tr>
	    <td>User_id</td>
		<td>UserName</td>
		<td>Email</td>
		<td>User_Type</td>
		<td>Action</td>
	  </tr>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result)) {
			?>
	  <tr>
	    <td><?php echo $row["id"]; ?></td>
		<td><?php echo $row["username"]; ?></td>
		<td><?php echo $row["email"]; ?></td>
		<td><?php echo $row["user_type"]; ?></td>
		<td><a href="update-process.php?id=<?php echo $row["id"]; ?>">Update</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
</table>
 <?php
}
else
{
    echo "No result found";
}
?>
 </body>
</html>