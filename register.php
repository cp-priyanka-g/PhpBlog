<?php
$errors = [];

include "connection.php";

if (isset($_POST["reg_user"])) {
    $uname = $_POST["username"];
    $emailid = $_POST["email"];
    $pass1 = $_POST["password_1"];
    $pass2 = $_POST["password_2"];

    $username = mysqli_real_escape_string($db, $uname);
    $email = mysqli_real_escape_string($db, $emailid);
    $password_1 = mysqli_real_escape_string($db, $pass1);
    $password_2 = mysqli_real_escape_string($db, $pass2);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user["username"] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user["email"] === $email) {
            array_push($errors, "email already exists");
        }
    }

    if (count($errors) == 0) {
        // $password = md5($password_1);

        $query = "INSERT INTO users (username, email, upassword, user_type, ustatus)VALUES('$username', '$email', '$password_1','General','Active')";

        if ($db->query($query) === true) {
            echo "New record created successfully";
            header("location: login.php");
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }

        $conn->close();
    }
}
?>
  <?php if (count($errors) > 0): ?>
  <div class="error">
  	<?php foreach ($errors as $error): ?>
  	  <p><?php echo $error; ?></p>
  	<?php endforeach; ?>
  </div>
<?php endif; ?>
<!DOCTYPE html>
<html>
<head>
  <title>MyBlog Post in Php</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">

  	<div class="input-group">
  	  <label>Full Name</label>
  	  <input type="text" name="username">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" >
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>

</body>
</html>

