<?php
require_once 'layout/header.php';

if (isset($_GET['error'])) {
    $message = ErrorCode::getErrorMessage(intval($_GET['error']));
}

?>

<div class="container d-flex flex-column align-items-center">
        <h1>Connexion</h1>
        <div class="text-danger">
            <?php if (isset($message)) { echo $message; } ?>
        </div>
        <form method="POST" action="auth.php" class="w-50">
            <div class="form-group my-2">
                <label for="login">Email :</label>
                <input type="email" class="form-control" name="log" />
            </div>
            <div class="form-group my-2">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" name="pass" />
            </div>
            
            <button type="submit" class="btn btn-success my-2">Connexion</button>
        </form>
</div>

<?php
require_once 'layout/footer.php';
