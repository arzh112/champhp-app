<?php
require_once 'layout/header.php';
require_once 'classes/Utils.php';

if (isset($_GET['error'])) {
    $message = ErrorCode::getErrorMessage(intval($_GET['error']));
}

if (!empty($_POST)) {

    [
        'email' => $email,
        'username' => $username,
        'password' => $password,
        'password-confirm' => $confirmPassword
    ] = $_POST;

    if($password != $confirmPassword) {
        Utils::redirect('register.php?error=' . ErrorCode::FAILD_CONFIRM_PASS);
    }

    if (empty($email) || empty($username) || empty($password)) {
        Utils::redirect('register.php?error=' . ErrorCode::FIELDS_REQUIRED);
    }

    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        Utils::redirect('register.php?error=' . ErrorCode::INVALID_EMAIL);
    }

    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO users (email, username, password_hash, admin_status) VALUES (:email, :username, :passwordHash, false)");
        $stmt->execute([
            ':email' => $email,
            ':username' => $username,
            ':passwordHash' => password_hash($password, PASSWORD_DEFAULT)
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
        <div class="form-group">
            <label for="password-confirm">Confirmation du mot de passe :</label>
            <input type="password" class="form-control" name="password-confirm" />
        </div>
        <button type="submit" class="btn btn-primary">Inscription</button>
    </form>
</div>

<?php
require_once 'layout/footer.php';