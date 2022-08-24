<?php
require_once '../inc/connection.php';
if (isset($_POST['submit'])) {

    $title = htmlspecialchars(trim($_POST['title']));
    $body = htmlspecialchars(trim($_POST['body']));

    if (isset($_SESSION['title'])) {
    $_SESSION['title'] = $title;
    }
    if (isset($_SESSION['body'])) {
    $_SESSION['body'] = $body;
    }

    $errors = [];

    //title
    if (empty($title)) {
        $errors[] = "title is required";
    } elseif (is_numeric($title)) {
        $errors[] = "title must be string";
    } elseif (strlen($title) > 255) {
        $errors[] = "title must be less than 255 character";
    }

    //body
    if (empty($body)) {
        $errors[] = "body is required";
    } elseif (is_numeric($body)) {
        $errors[] = "body must be string";
    }

    if ($_FILES == true  && $_FILES['image']['name']) {

        //image
        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $size = $image['size'];
        $sizeMB = $size / (1024 * 1024);
        $ext = pathinfo($imageName, PATHINFO_EXTENSION);
        $newName = uniqid() . "." . $ext;

        if ($sizeMB > 1) {
            $errors[] = "image size must be less than 1MB";
        } elseif (!in_array(strtolower($ext), ['png', 'jpg', 'jpeg', 'gif'])) {
            $errors[] = "image not correct";
        }
    } else {
        $newName = "";
    }

    if (empty($errors)) {
        $query = "insert into posts(`title`,`body`,`image`,`user_id`) values('$title','$body','$newName',1)";
        $result = mysqli_query($conn, $query);
        
        if ($result) {

            if ($_FILES['image']['name']) {
                move_uploaded_file($imageTmpName, "../uploads/$newName");
            }
            $_SESSION['success'] = ["post inserted successfuly"];
            header("location: ../index.php");
        } else {
            $_SESSION['errors'] = ["error while inserting"];
            header("location: ../create-post.php");
        }
    } else {
        $_SESSION['errors'] = $errors;
   
        header("location: ../create-post.php");
       

    }
} else {
    header("location: ../index.php");
}
