<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>
<?php
require_once 'inc/connection.php';

if (isset($_GET['id'])) {
    $id = ($_GET['id']);
} else {
    header("location:index.php");
}
$query = "select * from posts where id=$id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $post = mysqli_fetch_assoc($result);
} else {
    $error = "no data founded";
}
mysqli_close($conn);
?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3><?= $post['title'] ?></h3>
                </div>
                <div>
                    <a href="index.php" class="text-decoration-none">Back</a>
                </div>
            </div>
            <div>
                <?= $post['body'] ?>
            </div>
            <div>
                <img src="uploads/<?= $post['image'] ?>" alt="" srcset="" width="300px">
            </div>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>