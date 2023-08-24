<?php
require_once 'data/data.php';
require_once 'classes/ErrorCode.php';
require_once 'classes/Utils.php';

if (empty($_POST['log']) || empty($_POST['pass'])) {
    Utils::redirect('login.php?error=' . ErrorCode::FIELDS_REQUIRED);
}

[
    'log' => $login,
    'pass' => $password
] = $_POST;


foreach($users as $user) {
    if ($login === $user->getEmail() && $password === $user->getPassword()) {
        session_start();
        $_SESSION['login'] = 'user1@user.com';
        Utils::redirect('index.php');
    }
}

foreach($admins as $admin)
if ($login === $admin->getEmail() && $password === $admin->getPassword() ) {
    session_start();
    $_SESSION['login'] = 'admin@admin.com';
    Utils::redirect('administration.php');
}

Utils::redirect('login.php?error=' . ErrorCode::INVALID_CREDENTIALS);



