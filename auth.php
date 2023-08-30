<?php
require_once 'data/data-users.php';
require_once 'classes/ErrorCode.php';
require_once 'classes/Utils.php';

if (empty($_POST['log']) || empty($_POST['pass'])) {
    Utils::redirect('login.php?error=' . ErrorCode::FIELDS_REQUIRED);
}

[
    'log' => $login,
    'pass' => $password
] = $_POST;

if (filter_var($login, FILTER_VALIDATE_EMAIL) === false) {
    Utils::redirect('login.php?error=' . ErrorCode::INVALID_EMAIL);
}

foreach($clients as $client) {
    if ($login === $client->getEmail() && $password === $client->getPassword()) {
        session_start();
        $_SESSION['login'] = $client->getEmail();
        Utils::redirect('index.php');
    }
}

foreach($admins as $admin)
if ($login === $admin->getEmail() && $password === $admin->getPassword() ) {
    session_start();
    $_SESSION['login'] = $admin->getEmail();
    Utils::redirect('administration.php');
}

Utils::redirect('login.php?error=' . ErrorCode::INVALID_CREDENTIALS);



