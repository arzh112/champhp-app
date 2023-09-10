<?php
require_once 'layout/header.php';
require_once 'classes/ErrorCode.php';
require_once 'classes/Mushroom.php';
require_once 'classes/Picture.php';
require_once 'classes/Utils.php';
require_once 'functions/db.php';

if (isset($_GET['error'])) {
    $message = ErrorCode::getErrorMessage(intval($_GET['error']));
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    if(intval($_GET['message']) === 1) {
        $message= 'La photo est enregistrée avec succès';
    }
}

try {
    if (isset($_GET['id'])) {
        $mushroomsId = intval($_GET['id']);
        $pdo = getDbConnection();
        $mushroom = Mushroom::getDataById($pdo, $mushroomsId); 
        $pictures = Picture::getPicturesByMushroomsId($pdo, $mushroomsId);
    }
    
    if (isset($_FILES['newPicture'])) {

        if (empty($_SESSION)) {
            Utils::redirect('login.php?error=' . ErrorCode::LOGIN_REQUIRED);
        }

        $usersId = intval($_SESSION['id']);

        if ($_FILES['newPicture']['error'] === UPLOAD_ERR_NO_FILE) {
            throw new Exception(ErrorCode::getErrorMessage(ErrorCode::FIELDS_REQUIRED));
        }
        
        if ($_FILES['newPicture']['error'] === UPLOAD_ERR_INI_SIZE) {
            throw new Exception("Le fichier est trop lourd");
        }
        
        if ($_FILES['newPicture']['type'] != 'image/jpeg') {
            throw new Exception("Veuillez sélectionner une photo au format JPG uniquement");
        }

        [
            'name' => $name,
            'full_path' => $path,
            'type' => $type,
            'tmp_name' => $tmpName,
            'error' => $error,
            'size' => $size
        ] = $_FILES['newPicture'];

    if ($_FILES['newPicture']['error'] === UPLOAD_ERR_OK) {
        Picture::addToDB($pdo, $name, $path, $type, $size, $mushroomsId, $usersId);
        $file = $_FILES['newPicture'];
        $destination = "assets/uploads/" . $path;
        if(move_uploaded_file($file['tmp_name'], $destination) === false) {
            throw new Exception("L'ajout de la photo au dossier de destination à échoué");
        }
        //$message = "La photo à été enregistré avec succès";
        Utils::redirect('mushrooms-details.php?id=' . $mushroomsId .'&message=1');

    }
}

} catch (PDOException) {
    $message = "Erreur lors de la requête";
} catch (Exception $ex) {
    $message = $ex->getMessage();
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
