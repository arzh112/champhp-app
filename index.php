<?php
require_once 'layout/header.php';
require_once 'classes/Mushroom.php';

try {
    $pdo = getDbConnection();
    $mushrooms = Mushroom::getData($pdo);
} catch (PDOException) {
    echo ErrorCode::getErrorMessage(ErrorCode::FAILD_DB_CONNECT);
    exit;
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <?php if (isset($mushrooms)) { 
            foreach ($mushrooms as $mushroom) {
                require 'layout/card-template.php';
            }
        } ?>
    </div>
</div>

<?php
require_once 'layout/footer.php';
