<?php
require_once '../inc/connection.php';
if (isset($_GET['id'])) {
    $id = ($_GET['id']);

    $title = htmlspecialchars(trim($_POST['title']));
    $body = htmlspecialchars(trim($_POST['body']));

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

    $query = "SELECT * FROM `posts` WHERE id=$id";
    $result = mysqli_query($conn,$query);
    
    if(mysqli_num_rows($result)==1){
        $post = mysqli_fetch_assoc($result);
    }
    $oldName = $post['image'];

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
        $newName = $oldName;
    }

    if (empty($errors)) {
        $selecQuery = "select * from posts where id=$id";
        $result = mysqli_query($conn, $selecQuery);
        if (mysqli_num_rows($result) > 0) {
            
            $updateQuery = "update  posts set `title`='$title',`body`='$body' ,`image`='$newName' where id=$id";
            $result = mysqli_query($conn, $updateQuery);
            if ($result) {
    
                if ($_FILES['image']['name']) {
                    move_uploaded_file($imageTmpName, "../uploads/$newName");
                    unlink("../uploads/$oldName");
                }
                $_SESSION['success'] = ["post updated successfuly"];
                header("location: ../show-post.php?id=$id");
            } else {
                // errors
                header("location: ../edit-post.php");
            }

        }else{
                //errors
        }   

    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['title'] = $title;
        $_SESSION['body'] = $body;
        header("location: ../edit-post.php");
    }

} else {
    header("location: ../index.php");
}
