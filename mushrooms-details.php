<?php
require_once 'layout/header.php';
require_once 'classes/ErrorCode.php';
require_once 'classes/Mushroom.php';
require_once 'classes/Picture.php';
require_once 'functions/db.php';

if (isset($_GET['error'])) {
    $message = ErrorCode::getErrorMessage(intval($_GET['error']));
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}

try {
    if (isset($_GET['id'])) {
        $mushroomsId = intval($_GET['id']);
        $pdo = getDbConnection();
        $mushroom = Mushroom::getDataById($pdo, $mushroomsId); 
        $pictures = Picture::getPicturesByMushroomsId($pdo, $mushroomsId);
    }      
} catch (PDOException) {
    echo "Erreur lors de la requête";
    exit;
}
?>

<div class="container my-5">
<?php 
    require_once 'layout/mush-details-template.php'; ?>
    <div class="row my-5">
    <?php foreach($pictures as $picture) {
        try {
            $username = $picture->getPicturesUsername($pdo);
        } catch(PDOException) {
            echo "Erreur lors de la requête";
            exit;
        }
        require 'layout/pictures-list-template.php';
    } ?>
    </div>
</div>
