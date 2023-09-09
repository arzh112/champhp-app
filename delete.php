<?php
require_once 'classes/IgetData.php';
require_once 'classes/IgetDataById.php';
require_once 'classes/Picture.php';
require_once 'classes/Utils.php';
require_once 'classes/ErrorCode.php';
require_once 'functions/db.php';


try{
    if($_GET["picturesId"] ?? null) {
        $pdo = getDbConnection();
        $picturesId = $_GET["picturesId"];
        Picture::deletePicture($pdo, $picturesId);
        Utils::redirect('account.php?message=La suppression est éffectuée');
    }
} catch (PDOException) {
    echo "Erreur lors de la requête";
    exit;
}
