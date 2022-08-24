<?php
require_once 'inc/header.php'; ?>
<?php require_once 'inc/navbar.php'; ?>
<?php require_once 'handle/functions.php'; ?>

<?php if (isset($_SESSION['user_id'])) { ?>
    <?php
    require_once 'inc/connection.php';

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $totalQuery = "select count(id) as total from posts";
    $runQuery = mysqli_query($conn, $totalQuery);
    if (mysqli_num_rows($runQuery) > 0) {
        $posts = mysqli_fetch_assoc($runQuery);
        $totalcount = $posts['total'];
    }

    $limit = 3;
    $offset = ($page - 1) * $limit;
    $numberOfPages = ceil($totalcount / $limit);

    if (!validate($page, $numberOfPages)) {
        header("location:" . $_SERVER['PHP_SELF'] . "?page=1");
    }

    $query = "select id, title, created_at from posts limit $limit offset $offset";
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

    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?php if ($page == 1) echo "disabled" ?>">
                    <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=" . $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">page <?php echo $page ?> of <?php echo $numberOfPages ?></a></li>
                <li class="page-item <?php if ($page == $numberOfPages) echo "disabled" ?>">
                    <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=" . $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <?php require_once('inc/footer.php'); ?>
<?php
} else {
    header("location: login.php");
}
?>