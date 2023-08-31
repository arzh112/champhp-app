<?php
require_once 'layout/header.php';
require_once 'classes/Mushroom.php';

try {
    $mushrooms = getDbMushrooms();
} catch (PDOException) {
    $message = ErrorCode::getErrorMessage(ErrorCode::FAILD_DB_CONNECT);
}
?>


<div class="container">
    <div class="row">
        <?php if (isset($mushrooms)) { 
            foreach ($mushrooms as $mushroom) {
                require 'layout/card-template.php';
            }
        } ?>

    </div>
</div>



<?php
require_once 'layout/footer.php';
