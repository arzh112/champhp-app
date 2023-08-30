<?php
require_once 'functions/db.php';
require_once 'classes/Admin.php';
require_once 'classes/Client.php';


try {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM users");
    $usersArray = $stmt->fetchAll();
}catch (PDOException) {
    echo "erreur lors de la requête";
    exit;
}

if(isset($usersArray)) {
    for ($i = 0; $i < count($usersArray); $i++) {
            if($usersArray[$i]['admin'] === 1) {
                var_dump($usersArray[$i]['id']);
                $admins[] = new Admin($usersArray[$i]['id'], $usersArray[$i]['email'], $usersArray[$i]['username'], $usersArray[$i]['password']);
                $users[] = new Admin($usersArray[$i]['id'], $usersArray[$i]['email'], $usersArray[$i]['username'], $usersArray[$i]['password']);
            }
            if($usersArray[$i]['admin'] === 0) {
                $clients[] = new Client($usersArray[$i]['id'], $usersArray[$i]['email'], $usersArray[$i]['username'], $usersArray[$i]['password']);
                $users[] = new Client($usersArray[$i]['id'], $usersArray[$i]['email'], $usersArray[$i]['username'], $usersArray[$i]['password']);
            }
        } 
    }

var_dump($users);
var_dump($clients);
var_dump($admins);
?>