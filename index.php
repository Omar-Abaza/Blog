<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>
<?php
require_once 'inc/connection.php';

$query = "select id, title, created_at from posts";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $error = "no data founded";
}
?>

<div class="container-fluid pt-4">
<?php
            if (isset($_SESSION['success'])) {
                foreach ($_SESSION['success'] as $success) { ?>
                    <div class="alert alert-success"><?= $success ?></div>
            <?php }
                unset($_SESSION['success']);
            }
            
            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $error) { ?>
                    <div class="alert alert-danger"><?= $error ?></div>
            <?php }
                unset($_SESSION['errors']);
            }
            ?>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3>All posts</h3>
                </div>
                <div>
                    <a href="create-post.php" class="btn btn-sm btn-success">Add new post</a>
                </div>
            </div>
            <?php if (!empty($posts)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Published At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post) : ?>
                            <tr>
                                <td><?= $post['title']; ?></td>
                                <td><?= $post['created_at']; ?></td>
                                <td>
                                    <a href="show-post.php?id=<?= base64_encode($post['id']); ?>" class="btn btn-sm btn-primary">Show</a>
                                    <a href="edit-post.php?id=<?= base64_encode($post['id']); ?>" class="btn btn-sm btn-secondary">Edit</a>
                                    <a href="handle/delete-post.php?id=<?= base64_encode($post['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('do you really want to delete post?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert alert-danger m-2"><?php echo $error; ?></div>
            <?php endif ?>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>