<?php require_once 'inc/header.php'; ?>
<?php require_once 'inc/navbar.php'; ?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3><?= $message['Login'] ?></h3>
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
            ?>
            <form method="POST" action="handle/handle-login.php">
    
                <div class="mb-3">
                    <label for="email" class="form-label"><?= $message['Email'] ?></label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
    
                <div class="mb-3">
                    <label for="password" class="form-label"><?= $message['Password'] ?></label>
                    <input type="password" class="form-control" id="password"  name="password">
                </div>
                
                <button type="submit" class="btn btn-primary" name="submit"><?= $message['Login'] ?></button>
            </form>
        </div>
    </div>
</div>

<?php require_once ('inc/footer.php'); ?>