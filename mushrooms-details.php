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
        $mushrooms = getDbMushrooms();
        $mushPictures = getMushroomsPictures($mushroomsId);
        $picturesUsername = getPicturesUsername();
        if (isset($mushrooms)) {
            foreach ($mushrooms as $m) {
                $m->getId();
                if ($m->getId() === $mushroomsId) {
                    $mushroom = $m;
                }
            }
        }
    }
} catch (PDOException) {
    echo "Erreur lors de la requête";
    exit;
}
?>

<div class="container my-5">
    <div class="row align-text-center">
        <div class="col-6">
            <h1><?php echo $mushroom->getName(); ?></h1>
            <h3><i><?php echo $mushroom->getLatinName(); ?></i></h3>
            <p>Genre : <?php echo $mushroom->getGenus(); ?></p>
            <h5><?php echo $mushroom->getCategory(); ?></h5>
            <h3>Habitat</h3>
            <p><?php echo $mushroom->getHabitat(); ?></p>
            <h3>Description</h3>
            <p><?php echo $mushroom->getDescription(); ?></p>
        </div>
        <div class="col-6">
            <img src="assets/pictures/<?php echo $mushroom->getMainPicture(); ?>" class="img-fluid rounded" alt="">
            <div class="text-danger">
                <?php if (isset($message)) {
                    echo $message;
                } ?>
            </div>
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="newPicture" class="my-2">Ajoûter une photo :</label>
                    <input type="file" name="newPicture" class="form-control my-2" />
                    <input type="hidden" name="mushroomsId" value="<?php echo $mushroom->getId(); ?>">
                    <button type="submit" class="btn btn-success my-2">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row my-5">
        <?php foreach ($mushPictures as $picture) { ?>
            <?php foreach($picturesUsername as $pu) {
                if($picture->getId() === $pu['picturesId']) {
                    $username = $pu['username'];
                }
            } ?>
            <div class="card col-2 px-0 mx-2">
                <img class="card-img-top img-fluid rounded" src="assets/uploads/<?php echo $picture->getPath(); ?>"  alt="">

                <div class="d-flex justify-content-between">
                    <p><?php echo $picture->getDate(); ?></p>
                    <p><?php echo $username; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>