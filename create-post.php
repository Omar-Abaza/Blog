<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/navbar.php'; ?>
<?php if (isset($_SESSION['user_id'])) { ?>
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="d-flex justify-content-between border-bottom mb-5">
                    <div>
                        <h3><?= $message['Add new post'] ?></h3>
                    </div>
                    <div>
                        <a href="index.php" class="text-decoration-none"><?= $message['Back'] ?></a>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['errors'])) {
                    foreach ($_SESSION['errors'] as $error) { ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                <?php }
                    unset($_SESSION['errors']);
                }
                if (isset($_SESSION['title'])) {
                    $title = $_SESSION['title'] ;
                    }
                    if (isset($_SESSION['body'])) {
                     $body=$_SESSION['body'] ;
                    }
                ?>
                <form method="POST" action="handle/store-post.php" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="title" class="form-label"><?= $message['Title'] ?></label>
                        <input type="text" class="form-control" id="title" value="<?php if (isset($_SESSION['title'])) { echo $title; } ?>" name="title">
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label"><?= $message['Body'] ?></label>
                        <textarea class="form-control" id="body" name="body" rows="5"><?php if (isset($_SESSION['body'])) { echo $body; } ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label"><?= $message['Image'] ?></label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit"><?= $message['Submit'] ?></button>
                </form>
            </div>
        </div>
    </div>

    <?php require_once('inc/footer.php'); ?>
<?php
} else {
    header("location: login.php");
}
?>