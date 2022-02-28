
<?php
session_start();

if (isset($_POST["post_btn"])) {
    $db = mysqli_connect("localhost", "root", "", "myblog");
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $title = $_POST["title"];
    $desc = $_POST["description"];
    $create_date = $_POST["create_date"];
    $author = $_POST["author"];
    $category = $_POST["category"];

    $filename = $_FILES["myfile"]["name"];
    $target_dir = "uploads/" . $filename;
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " .
            basename($_FILES["fileToUpload"]["name"]) .
            " has been uploaded.";
    }

    $query = "INSERT INTO posts (title,descriptionbox,created_date,author,category,featureimage)VALUES('$title', '$desc', '$create_date','$author','$category','$target_file')";
    mysqli_query($db, $query);

    $query2 =
        "INSERT INTO view_post (admin_id,view_status)VALUES('1','Active')";
    mysqli_query($db, $query2);

    die($query);
    die($query2);
    $db->close();
    header("location: adminHome.php");
}


?>
