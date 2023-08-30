<?php
require_once 'layout/header.php';
require_once 'classes/Utils.php';
require_once 'classes/ErrorCode.php';
require_once 'functions/db.php';

if (isset($_GET['error'])) {
    require_once 'classes/ErrorCode.php';
    $message = ErrorCode::getErrorMessage(intval($_GET['error']));
}

if (!empty($_POST)) {
    require_once 'classes/Utils.php';
    [
        'email' => $email,
        'username' => $username,
        'password' => $password
    ] = $_POST;

    if (empty($email) || empty($username) || empty($password)) {
        Utils::redirect('register.php?error=' . ErrorCode::FIELDS_REQUIRED);
    }

    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        Utils::redirect('register.php?error=' . ErrorCode::INVALID_EMAIL);
    }

    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO users (email, username, passwordHash) VALUES (:email, :username, :passwordHash)");
        $stmt->execute([
            ':email' => $email,
            ':username' => $username,
            ':passwordHash' => $password
        ]);
    } catch(PDOException) {
        echo "erreur lors de la requête";
        exit;
    }
}


?>

<div class="container">
    <h1>Créer un compte</h1>
    <div class="text-danger">
        <?php if (isset($message)) { echo $message; } ?>
    </div>
    <form method="POST">
        <div class="form-group">
            <label for="email">E-mail :</label>
            <input type="text" class="form-control" name="email" />
        </div>
        <div class="form-group">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" class="form-control" name="username" />
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" name="password" />
        </div>
        <button type="submit" class="btn btn-primary">Inscription</button>
    </form>
</div>

<?php
require_once 'layout/footer.php';