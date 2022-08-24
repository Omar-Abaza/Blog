<?php
require_once '../inc/connection.php';

if (isset($_GET['id'])) {
    $id = ($_GET['id']);
    $mysql_id = base64_decode($_GET['id']);
    $selectQuery = "select * from posts where id=$mysql_id";
    $result = mysqli_query($conn, $selectQuery);

    if (mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
        $image = $post['image'];
        unlink("../uploads/$image");

        $query = "DELETE FROM  posts WHERE id=$mysql_id";
        $result = mysqli_query($conn, $query);

        // AutoIncrement id
        $dropId = "ALTER TABLE posts DROP id";
        $reDropId = mysqli_query($conn, $dropId);
        $autoIncrement = "ALTER TABLE posts AUTO_INCREMENT = 1";
        $reAutoIncrement = mysqli_query($conn, $autoIncrement);
        $addId = "ALTER TABLE posts ADD id int unsigned NOT null AUTO_INCREMENT PRIMARY KEY FIRST";
        $readdId  = mysqli_query($conn, $addId);

        if ($result) {
            $_SESSION['success'] = ["post deleted successfuly"];
            header("location: ../index.php");
        }
    } else {
        $_SESSION['errors'] = ["no data founded"];
        header("location: ../index.php");
    }
} else {
    header("location: ../index.php");
}
