<?php
session_start();
require_once 'classes/Admin.php';
require_once 'classes/User.php';
require_once 'classes/Client.php';
require_once 'classes/ErrorCode.php';
require_once 'functions/db.php';

try {
    $pdo = getDbConnection();
    $admins = Admin::getData($pdo);
    $clients = Client::getData($pdo);
    $users = [...$admins, ...$clients];
} catch (PDOException) {
    $message = ErrorCode::getErrorMessage(ErrorCode::FAILD_DB_CONNECT);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title><?php echo isset($title) ? $title : "ChamPHP"; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light w-100 d-flex justify-content-between">
        <a class="navbar-brand mx-5 my-3" href="index.php">ChamPHP</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100 justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <?php if (isset($admins)) { ?>
                    <?php foreach ($admins as $admin) { ?>
                        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === $admin->getEmail()) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin-photo.php">Photos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin-mushroom.php">Champignons</a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </ul>

            <div class="d-flex mx-5">
                <?php if (isset($_SESSION['login'])) { ?>
                    <?php foreach ($users as $u) { ?>
                        <?php if ($u->getEmail() === $_SESSION['login']) { ?>
                            <?php $username = $u->getUsername(); ?>
                        <?php } ?>
                    <?php } ?>
                    <button type="button" class="btn btn-outline-success mx-2">
                        <a class="nav-link" href="account.php"><?php echo $username ?></a>
                    <button type="button" class="btn btn-success mx-2">
                        <a class="nav-link" href="logout.php">Déconnexion</a>
                    </button>

                <?php } else { ?>
                    <button type="button" class="btn btn-success mx-2">
                        <a class="nav-link" href="login.php">Connexion</a>
                    </button>
                    <button type="button" class="btn btn-success mx-2">
                        <a class="nav-link" href="register.php">Inscription</a>
                    </button>
                <?php } ?>
            </div>
        </div>
    </nav>

    <div class="text-danger">
        <?php if (isset($message)) {
            echo $message;
        } ?>
    </div>