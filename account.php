<?php
require_once 'layout/header.php';
require_once 'classes/Picture.php';

if (empty($_SESSION)) {
    Utils::redirect('login.php?error=' . ErrorCode::LOGIN_REQUIRED);
}

if($_GET['message'] ?? null) {
    $message = $_GET['message'];
}

try {
    $pdo = getDbConnection();
    $usersId = $_SESSION['id'];
    if ($_SESSION['admin_status'] === true) {
        $user = Admin::getDataById($pdo, $usersId);
    }
    if ($_SESSION['admin_status'] === false) {
        $user = Client::getDataById($pdo, $usersId);
    }
    $usersPictures = Picture::getUsersPictures($pdo, $usersId);
} catch (PDOException) {
    echo 'erreur lors de la requête';
    exit;
}

?>
<div class="container">

    <h1>Bienvenue, <?php echo $user->getUsername(); ?></h1>

    <h2>Votre bibliothèque de photo :</h2>
    <div class="text-danger">
        <?php if (isset($message)) { echo $message; } ?>
    </div>

    <div class="row">
        <?php foreach ($usersPictures as $picture) { ?>
            <div class="card col-2 px-0 mx-2">
                <img class="card-img-top img-fluid rounded" src="assets/uploads/<?php echo $picture->getPath(); ?>" alt="">
                <div class="justify-content-between">
                    <p><?php echo $picture->getDate(); ?></p>
                    <p><?php echo $username; ?></p>
                </div>
                <form action="delete.php" method="GET">
                    <button class="btn btn-danger" name="picturesId" value="<?php echo $picture->getId(); ?>" >Supprimer</button>
                </form>
            </div>
        <?php } ?>
    </div>
</div>

<?php
require_once 'layout/footer.php';
