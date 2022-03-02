<?php // LOGIN USER

$errors = [];
session_start();

$db = mysqli_connect("localhost", "root", "", "myblog");

if (isset($_POST["login_user"])) {
    $uname = $_POST["username"];
    $pass1 = $_POST["password"];
    $username = mysqli_real_escape_string($db, $uname);
    $password = mysqli_real_escape_string($db, $pass1);

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
        $logged_in_user = mysqli_fetch_assoc($results);

        if (mysqli_num_rows($results) == 1) {
            // user found
            // check if user is admin or user

            if ($logged_in_user["user_type"] == "admin") {
                $_SESSION["user"] = $logged_in_user["username"];
                $_SESSION["success"] = "You are now logged in";
                header("location: adminHome.php");
            }
            if ($logged_in_user["user_type"] == "General") {
                $_SESSION["user_status"] = $logged_in_user["ustatus"];
                $_SESSION["username"] = $username;
                $_SESSION["success"] = "You are now logged in";
                header("location: userHome.php");
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>
