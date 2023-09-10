<?php
// N'est plus utilisée, l'upload se fait directement sur la page mushrooms-details.php 
session_start();
require_once 'classes/Utils.php';
require_once 'classes/ErrorCode.php';
require_once 'classes/IgetData.php';
require_once 'classes/IgetDataById.php';
require_once 'classes/Picture.php';
require_once 'functions/db.php';

if (empty($_SESSION)) {
    Utils::redirect('login.php?error=' . ErrorCode::LOGIN_REQUIRED);
}

if (empty($_FILES['newPicture']['name'])) {
    Utils::redirect('mushrooms-details.php?id=' . $_POST['mushroomsId'] . '&error=' . ErrorCode::FIELDS_REQUIRED);
}

$mushroomsId = intval($_POST['mushroomsId']);
$usersId = intval($_SESSION['id']);

[
    'name' => $name,
    'full_path' => $path,
    'type' => $type,
    'tmp_name' => $tmpName,
    'error' => $error,
    'size' => $size
] = $_FILES['newPicture'];

try {
    $pdo = getDbConnection();
    Picture::addToDB($pdo, $name, $path, $type, $size, $mushroomsId, $usersId);
    if (isset($_FILES['newPicture'])) {
        $file = $_FILES['newPicture'];
        $destination = "assets/uploads/" . $path;
        if(move_uploaded_file($file['tmp_name'], $destination) === false) {
            throw new Exception("L'ajout de la photo au dossier de destination à échoué");
        }
        Utils::redirect('mushrooms-details.php?id=' . $_POST['mushroomsId'] . '&message=La photo est enregistrée');
    }
} catch (PDOException) {
    echo 'Erreur lors de la requête';
    //Utils::redirect('mushrooms-details.php?message=Erreur lors de la requête');
    exit;
} catch (Exception) {
    echo 'Erreur ajout dossier';
    //Utils::redirect("mushroom-details.php?message=L'ajout de la photo au dossier de destination à échoué");
    exit;
}


