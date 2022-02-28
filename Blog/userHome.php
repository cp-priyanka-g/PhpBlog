<?php include "server.php"; ?>
<?php
session_start();
$user_i = $_SESSION["uid"];
if (!isset($_SESSION["username"])) {
    $_SESSION["msg"] = "You must log in first";
    header("location: login.php");
}
if (isset($_GET["logout"])) {
    session_destroy();
    unset($_SESSION["username"]);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
table, th, td {
  border: 1px solid black;
}
</style>
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION["success"])): ?>
      <div class="error success" >
      	<h3>
          <?php
          echo $_SESSION["success"];
          unset($_SESSION["success"]);
          ?>
      	</h3>
      </div>
  	<?php endif; ?>

    <!-- logged in user information -->
    <?php if (isset($_SESSION["username"])): ?>
    	<p>Welcome <strong><?php echo $_SESSION["username"]; ?></strong></p>
    	<p> <a href="login.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif; ?>
</div>

<?php
session_start();
$user_i = $_SESSION["uid"];
$db = mysqli_connect("localhost", "root", "", "myblog");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
$sql =
    "select v.view_status, p.pid, p.title, p.descriptionbox, p.created_date, p.author, p.category, p.featureimage  from posts as p  join view_post as v  on p.pid = v.post_id where v.view_status='Active' GROUP BY v.post_id";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Title</th><th>Description</th><th>Date</th><th>Author</th> <th>Category</th> <th>Image</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $imageURL = "uploads/" . $row["featureimage"];
        echo "<tr><td>" .
            $row["pid"] .
            "</td> <td>" .
            $row["title"] .
            "</td> <td>" .
            $row["descriptionbox"] .
            "</td> <td>" .
            $row["created_date"] .
            "</td> <td>" .
            $row["author"] .
            "</td><td>" .
            $row["category"] .
            "</td><td><img src=" .
            $imageURL .
            "alt= /></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$db->close();
?>
		

</body>
</html>