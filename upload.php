<?php
session_start();
require_once 'classes/Utils.php';
require_once 'classes/ErrorCode.php';
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
    $stmt = $pdo->prepare("INSERT INTO pictures (title, picture_path, size, mushrooms_id, users_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $name,
        $path,
        $size,
        $mushroomsId,
        $usersId
    ]);
} catch (PDOException) {
    echo "erreur lors de la requête";
    exit;
}

if (isset($_FILES['newPicture'])) {
    // on met le fichier dans une variable pour une meilleure lisibilité
    $file = $_FILES['newPicture'];

    // On construit le chemin de destination
    $destination = "assets/uploads/" . $path;

    // On bouge le fichier temporaire dans la destination
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        Utils::redirect('mushrooms-details.php?id=' . $_POST['mushroomsId'] . '&message=La photo est enregistrée');
    }
}
