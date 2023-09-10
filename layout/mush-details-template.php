
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
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="newPicture" class="my-2">Ajoûter une photo :</label>
                <input type="file" name="newPicture" class="form-control my-2" />
                <button type="submit" class="btn btn-success my-2" name="mushroomsId" value="<?php echo $mushroom->getId(); ?>">Envoyer</button>
            </div>
        </form>
    </div>
</div>
