<?php
require_once 'layout/header.php';
require_once 'classes/Picture.php';

if (empty($_SESSION)) {
    Utils::redirect('login.php?error=' . ErrorCode::LOGIN_REQUIRED);
}

if ($_SESSION['admin_status'] === false) {
    Utils::redirect('login.php?error=' . ErrorCode::ADMIN_ACCESS_ERROR);
}

if($_GET['message'] ?? null) {
    $message = $_GET['message'];
}

try {
    $pdo = getDbConnection();
    $usersId = $_SESSION['id'];
    if ($_SESSION['admin_status'] === true) {
        $admin = Admin::getDataById($pdo, $usersId);
    }
    $pictures = Picture::getData($pdo);
    if($_GET["deleteId"] ?? null) {
        $pdo = getDbConnection();
        $deleteId = $_GET["deleteId"];
        Picture::deletePicture($pdo, $deleteId);
    }
} catch (PDOException) {
    echo 'erreur lors de la requête';
    exit;
}

?>
<div class="container">

    <h1>Bienvenue, <?php echo $admin->getUsername(); ?></h1>

    <h2>Liste de toutes les photos postées:</h2>
    <div class="text-danger">
        <?php if (isset($message)) { echo $message; } ?>
    </div>

    <div class="row">
        <?php foreach ($pictures as $picture) { ?>
            <div class="card col-2 px-0 mx-2">
                <img class="card-img-top img-fluid rounded" src="assets/uploads/<?php echo $picture->getPath(); ?>" alt="">
                <div class="justify-content-between">
                    <p><?php echo $picture->getDate(); ?></p>
                    <p>Identifiant de l'utilisateur : <?php echo $picture->getUsersId(); ?></p>
                </div>
                <form action="delete.php" method="GET">
                    <button class="btn btn-danger" name="deleteId" value="<?php echo $picture->getId(); ?>" >Supprimer</button>
                </form>
            </div>
        <?php } ?>
    </div>
</div>

<?php
require_once 'layout/footer.php';