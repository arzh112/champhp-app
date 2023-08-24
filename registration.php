<?php
require_once 'layout/header.php';

if (!empty($_POST)) {
    require_once 'classes/User.php';
    require_once 'classes/Utils.php';
    require_once 'classes/ErrorCode.php';

    [
        'username' => $username,
        'email' => $email,
        'password' => $password
    ] = $_POST;

    try {
        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception(ErrorCode::getErrorMessage(ErrorCode::FIELDS_REQUIRED));
        }
        $newUser = new User($username, $email, $password);
        Utils::redirect('auth.php');
    } catch (InvalidArgumentException $ex) {
        $message = $ex->getMessage();
    } catch (Exception $ex) {
        $message = $ex->getMessage();
    }
}
?>


<div class="container">
    <h1>Inscription</h1>
    <div class="error">
        <?php if (isset($message)) {
            echo $message;
        } ?>
    </div>
    <form method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" />

        <label for="email">E-mail :</label>
        <input type="text" name="email" />

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" />
        <button type="submit">Inscription</button>
    </form>
</div>

<?php
require_once 'layout/footer.php';
