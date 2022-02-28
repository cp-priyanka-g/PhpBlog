<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "myblog");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
if (count($_POST) > 0) {
    mysqli_query(
        $db,
        "UPDATE users set ustatus='" .
            $_POST["view_status"] .
            "',user_type='" .
            $_POST["user_type"] .
            "' WHERE id='" .
            $_POST["userid"] .
            "'"
    );
    $message = "Record Modified Successfully";
}
$result = mysqli_query(
    $db,
    "SELECT * FROM users WHERE id='" . $_GET["id"] . "'"
);
$row = mysqli_fetch_array($result);
?>
<html>
<head>
<title>Update User Data</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if (isset($message)) {
    echo $message;
} ?>
</div>

Username: <br>
<input type="hidden" name="userid" class="txtField" value="<?php echo $row[
    "id"
]; ?>">
<input type="text" name="userid"  value="<?php echo $row["id"]; ?>">
<br>
User Type:<br>
  <select name="user_type" >
  <option value="<?php echo $row["user_type"]; ?>">"<?php echo $row[
    "user_type"
]; ?>"</option>
  <option value="admin">Admin</option>
  <option value="General">General</option>
  </select>
  <br>
View post: <br>

<select name="view_status" >
  <option value="<?php echo $row["ustatus"]; ?>">"<?php echo $row[
    "ustatus"
]; ?>"</option>
  <option value="Active">Active</option>
  <option value="Inactive">InActive</option>
  </select>
 <br>

<input type="submit" name="submit" value="Submit" class="button">
<a href="adminHome.php">BACK</a>
</form>
</body>
</html>


