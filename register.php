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

    try {
        $pdo = getDbConnection();
        
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
        <div class="form-group my-2">
            <label for="email">E-mail :</label>
            <input type="text" class="form-control" name="email" />
        </div>
        <div class="form-group my-2">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" class="form-control" name="username" />
        </div>
        <div class="form-group my-2">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" name="password" />
        </div>
        <div class="form-group my-2">
            <label for="password-confirm">Confirmation du mot de passe :</label>
            <input type="password" class="form-control" name="password-confirm" />
        </div>
        <button type="submit" class="btn btn-success my-2">Inscription</button>
    </form>
</div>

<?php
require_once 'layout/footer.php';