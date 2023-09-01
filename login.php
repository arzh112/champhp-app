<?php
require_once 'layout/header.php';

if (isset($_GET['error'])) {
    $message = ErrorCode::getErrorMessage(intval($_GET['error']));
}

?>

<div class="container">
    <div class="row justify-content-center">
        <h1>Connexion</h1>
        <div class="error">
            <?php if (isset($message)) {
                echo $message;
            } ?>
        </div>
        <form method="POST" action="auth.php">
            <div class="form-group">
                <label for="login">Email :</label>
                <input type="email" class="form-control" name="log" />
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" name="pass" />
            </div>
            
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
    
</div>

<?php
require_once 'layout/footer.php';
