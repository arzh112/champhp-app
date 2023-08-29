<?php
require_once 'classes/Client.php';
require_once 'classes/Admin.php';

try {
    $pdo = new PDO("mysql:host=host.docker.internal;port=3306;dbname=champhp-bdd;charset=utf8mb4", "root", "");
} catch (PDOException) {
    echo "la connexion à la BDD à échoué";
    exit;
}

$users = [
    $user = new Client('user@user.com', 'user', 'user'),
    $admin = new Admin('admin@admin.com', 'admin', 'admin'),
    $client = new Client('client@client.com', 'client', 'client')
];

$clients = [
    $client = new Client('user@user.com', 'user', 'user')
];

$admins = [
    $admin = new Admin('admin@admin.com', 'admin', 'admin')
];

$mushrooms = [];

?>