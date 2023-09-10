<?php
require_once 'classes/ErrorCode.php';
require_once 'classes/Utils.php';
require_once 'classes/Admin.php';
require_once 'classes/Client.php';
require_once 'functions/db.php';

try {
    $pdo = getDbConnection();
    $clients = Client::getData($pdo);
    $admins = Admin::getData($pdo);
} catch(PDOException) {
    Utils::redirect('register.php?error=' . ErrorCode::FAILD_DB_CONNECT);
}


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
    // var_dump($password);
    // var_dump($client->getPassword());
    // var_dump(password_verify($password, $client->getPassword()));
    if ($login === $client->getEmail() && password_verify($password, $client->getPassword())) {
        session_start();
        $_SESSION['id'] = $client->getId();
        $_SESSION['login'] = $client->getEmail();
        $_SESSION['admin_status'] = $client->getAdminStatus();
        Utils::redirect('index.php');
    }
}

foreach($admins as $admin) {
    var_dump($password);
    var_dump($admin->getPassword());
    var_dump(password_verify($password, $admin->getPassword()));
    if ($login === $admin->getEmail() && password_verify($password, $admin->getPassword())) {
        session_start();
        $_SESSION['id'] = $admin->getId();
        $_SESSION['login'] = $admin->getEmail();
        $_SESSION['admin_status'] = $admin->getAdminStatus();
        Utils::redirect('index.php');
    }
}

Utils::redirect('login.php?error=' . ErrorCode::INVALID_CREDENTIALS);



