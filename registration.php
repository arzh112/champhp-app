<?php
require_once 'layout/header.php';
require_once 'classes/ErrorCode.php';

if (!empty($_POST)) {
    require_once 'classes/User.php';
    require_once 'classes/Utils.php';
    require_once 'data/data.php';
    try {
        if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])) {
            throw new Exception(ErrorCode::getErrorMessage(ErrorCode::FIELDS_REQUIRED));
        }
        $newUser = new User($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password']);
        $users[] = $newUser;
        Utils::redirect('auth.php');
    } catch (InvalidArgumentException $ex) {
        $message = $ex->getMessage();
    } catch (Exception $ex) {
        $message = $ex->getMessage();
    }
}
?>

<h1>Inscription</h1>
<p><?php if(isset($message)) { echo $message; } ?></p>
<form method="POST">
    <label for="firstname">Prénom :
        <input type="text" name="firstname" />
    </label>
    <label for="lastname">Nom :
        <input type="text" name="lastname" />
    </label>
    <label for="email">E-mail :
        <input type="text" name="email" />
    </label>
    <label for="username">Nom d'utilisateur :
        <input type="text" name="username" />
    </label>
    <label for="password">Mot de passe :
        <input type="text" name="password" />
    </label>
    <button type="submit">Inscription</button>
</form>

<?php

require_once 'layout/footer.php';
