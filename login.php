<?php
require_once 'layout/header.php';

if (isset($_GET['error'])) {
    require_once 'classes/ErrorCode.php';
    $message = ErrorCode::getErrorMessage(intval($_GET['error']));
}

?>

<div class="container">
    <h1>Connexion</h1>
    <div class="error">
        <?php if (isset($message)) {
            echo $message;
        } ?>
    </div>
    <form method="POST" action="auth.php">
        <label for="login">Email :</label>
        <input type="email" name="log" />
        <label for="password">Mot de passe :</label>
        <input type="password" name="pass" />
        <button type="submit">Connexion</button>
    </form>
</div>

<?php
require_once 'layout/footer.php';
