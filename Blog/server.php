<?php
session_start();
$errors = array(); 


$db = mysqli_connect('localhost', 'root', '', 'myblog');


if (isset($_POST['reg_user'])) {

    $uname=$_POST['username'];
    $emailid=$_POST['email'];
    $pass1=$_POST['password_1'];
    $pass2=$_POST['password_2'];



  $username = mysqli_real_escape_string($db, $uname);
  $email = mysqli_real_escape_string($db, $emailid);
  $password_1 = mysqli_real_escape_string($db,$pass1 );
  $password_2 = mysqli_real_escape_string($db,$pass2);


  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }


  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }


  if (count($errors) == 0) {
  	$password = md5($password_1);

  	$query = "INSERT INTO users (username, email, upassword, user_type, ustatus)VALUES('$username', '$email', '$password','General','Active')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: userHome.php');
  }
}
