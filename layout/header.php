<?php
session_start();
require_once 'classes/Client.php';
require_once 'classes/Admin.php';
require_once 'data/data.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title><?php echo isset($title) ? $title : "Champhp"; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-end">
        <a class="navbar-brand" href="index.php">Champhp</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <?php foreach ($admins as $admin) { ?>
                    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === $admin->getEmail()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="users-admin.php">Gestion des utilisateurs</a>
                        </li>
                        <li>
                            <a class="nav-link" href="mushrooms-admin.php">Gestions des champignons</a>
                        </li>
                    <?php } ?>
                <?php } ?>
                </ul>
                
                <div>
                <?php if (isset($_SESSION['login'])) { ?>
                    <?php foreach ($users as $u) { ?>
                        <?php if ($u->getEmail() === $_SESSION['login']) { ?>
                            <?php $uName = $u->getUsername(); ?>
                        <?php } ?>
                    <?php } ?>
                    <button type="button" class="btn">
                        <a class="nav-link" href="count.php"><?php echo $uName ?></a>
                    </button>
                    <button type="button" class="btn">
                        <a class="nav-link" href="logout.php">Déconnexion</a>
                    </button>

                <?php } else { ?>
                    <button type="button" class="btn">
                        <a class="nav-link" href="login.php">Connexion</a>
                    </button>
                    <button type="button" class="btn">
                        <a class="nav-link" href="registration.php">Inscription</a>
                    </button>
                <?php } ?>
                </div> 
        </div>
    </nav>