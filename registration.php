<?php
require_once 'layout/header.php';

if (!empty($_POST)) {
    require_once 'classes/Client.php';
    require_once 'classes/Utils.php';
    require_once 'classes/ErrorCode.php';

    [
        'email' => $email,
        'username' => $username,
        'password' => $password
    ] = $_POST;

    try {
        $newClient = new Client($email, $username, $password);

        Utils::redirect('login.php');
    } catch (Exception $ex) {
        $message = $ex->getMessage();
    }
}
?>

<div class="container">
    <h1>Créer un compte</h1>
    <div class="error">
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
