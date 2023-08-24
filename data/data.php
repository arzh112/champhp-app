<?php
require_once 'classes/User.php';
require_once 'classes/Admin.php';

$users = [
    $user1 = new User('user1', 'user1@user.com', 'user1')
];

$admins = [
    $admin = new Admin('admin', 'admin@admin.com', 'admin')
];

$mushrooms = [];

?>