<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><?= $message['Blog'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php
                require_once 'connection.php';
                if (empty($_SESSION['user_id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><?= $message['Login'] ?></a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="handle/logout.php"><?= $message['Logout'] ?></a>
                    </li>
                <?php } ?>
                <?php
                if (isset($lang)) {
                    if ($lang == "ar") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="inc/change-lang.php?lang=en">English</a>
                        </li>

                    <?php   } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="inc/change-lang.php?lang=ar">العربية</a>
                        </li>

                <?php }
                }
                ?>
            </ul>
        </div>
    </div>
</nav>