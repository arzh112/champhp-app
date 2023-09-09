<?php
require_once 'layout/header.php';
require_once 'classes/Utils.php';
require_once 'classes/ErrorCode.php';
require_once 'classes/IgetData.php';
require_once 'classes/IgetDataById.php';
require_once 'classes/Picture.php';
require_once 'classes/Mushroom.php';
require_once 'functions/db.php';

if (isset($_GET['error'])) {
    $message = ErrorCode::getErrorMessage(intval($_GET['error']));
}

if($_GET['message'] ?? null) {
    $message = $_GET['message'];
}


try {
    $pdo = getDbConnection();
    $mushrooms = Mushroom::getData($pdo);
    foreach ($_POST as $post) {
        if (empty($post)) {
            throw new Exception(ErrorCode::getErrorMessage(ErrorCode::FIELDS_REQUIRED));
        }
    }
    if (isset($_POST) && isset($_FILES['mainPicture'])) {
        [
            'name' => $name,
            'latin_name' => $latinName,
            'genus' => $genus,
            'habitat' => $habitat,
            'category' => $category,
            'description' => $description,
            'mainPicture' => $mainPicture
        ] = $_POST;

        [
            'name' => $title,
        ] = $_FILES['mainPicture'];

        Mushroom::addToDB($pdo, $name, $latinName, $genus, $habitat, $category, $description, $title);
        
        if (isset($_FILES['mainPicture'])) {
            $file = $_FILES['mainPicture'];
            $destination = "assets/pictures/" . $path;
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                Utils::redirect('admin-mushroom.php?message=Le champignon a été ajouté avec succès');
            }
            throw new Exception("L'ajout de la photo au dossier de destination à échoué");
        }
    }
        
} catch (PDOException) {
    $message = "Erreur lors de la requête";
} catch (Exception $ex) {
    $message = $ex->getMessage();
}
?>

<div class="container d-flex flex-column align-items-center">
    <h1>Ajouter un champignon</h1>
    <div class="text-danger">
        <?php if (isset($message)) {
            echo $message;
        } ?>
    </div>
    <form method="POST" class="w-50" enctype="multipart/form-data">
        <div class="form-group my-2">
            <label for="mainPicture">Photo principale :</label>
            <input type="file" class="form-control" name="mainPicture" />
        </div>
        <div class="form-group my-2">
            <label for="name">Nom :</label>
            <input type="text" class="form-control" name="name" />
        </div>
        <div class="form-group my-2">
            <label for="latin_name">Nom latin :</label>
            <input type="text" class="form-control" name="latin_name" />
        </div>
        <div class="form-group my-2">
            <label for="genus">Genre :</label>
            <input type="text" class="form-control" name="genus" />
        </div>
        <div class="form-group my-2">
            <label for="habitat">Habitat :</label>
            <textarea class="form-control" name="habitat"></textarea>
        </div>
        <div class="form-group my-2">
            <label for="category">Category :</label>
            <select class="form-control" name="category" id="select-category">
                <option value="">Choisissez une catégorie</option>
                <option value="Comestible">Comestible</option>
                <option value="Indigeste">Indigeste</option>
                <option value="Toxique">Toxique</option>
                <option value="Mortel">Mortel</option>
            </select>
        </div>
        <div class="form-group my-2">
            <label for="description">Description :</label>
            <textarea class="form-control" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-success my-2">Ajouter</button>
    </form>
</div>

<?php
require_once 'layout/footer.php';
