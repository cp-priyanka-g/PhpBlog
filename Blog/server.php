<?php
        session_start();
        $errors = array(); 

    $uname=$_POST['username'];
    $emailid=$_POST['email'];
    $pass1=$_POST['password_1'];
    $pass2=$_POST['password_2'];

$db = mysqli_connect('localhost', 'root', '', 'myblog');


if (isset($_POST['reg_user'])) {

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
  	// $password = md5($password_1);

  	$query = "INSERT INTO users (username, email, upassword, user_type)VALUES('$username', '$email', '$password_1','General')";
    mysqli_query($db, $query);
  
    if ($db->query($query) === TRUE) {
      echo "New record created successfully" ;
    } else {
      echo "Error: " . $query . "<br>" . $db->error;
    }
    
    $conn->close();
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}
// LOGIN USER

$errors = array();

if (isset($_POST['login_user'])) {

    $uname=$_POST['username'];
     $pass1=$_POST['password'];
  
echo "hello $uname,$pass1";

    $username = mysqli_real_escape_string($db,$uname);
    $password = mysqli_real_escape_string($db,$pass1);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        // $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND upassword='$password'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {// user found
			// check if user is admin or user
            $logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: adminHome.php');		  
            }
            if ($logged_in_user['user_type'] == 'General'){
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: userHome.php');
            }
         
        }else {
            array_push($errors, "Wrong username/password combination");
        }

    }
  }
  ?> 
