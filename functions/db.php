<?php

function getDbConnection(): PDO
{
    $dbSettings = parse_ini_file(__DIR__ . '/../db.ini');
    [
      'DB_HOST' => $host,
      'DB_PORT' => $port,
      'DB_NAME' => $dbname,
      'DB_CHARSET' => $charset,
      'DB_USER' => $user,
      'DB_PASSWORD' => $password
    ] = $dbSettings;

    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset", 
        $user, 
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    return $pdo;
}

/**
 * Return an array of object with all users in data base
 *
 * @return array -- Array of object Admin and Client
 * @throws PDOException
 */
function getDbUsers(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM users");
    $usersArr = $stmt->fetchAll();
    foreach($usersArr as $u) {
        if($u['admin'] === 1) {
            $users[] = new Admin($u['id'], $u['email'], $u['username'], $u['password']);
        }
        if($u['admin'] === 0) {
            $users[] = new Client($u['id'], $u['email'], $u['username'], $u['password']);
        }
    } 
    return $users;
}

/**
 * Return an array of object with all admins in data base
 *
 * @return array -- Array of object Admin
 * @throws PDOException
 */
function getDbAdmins(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM users");
    $usersArr = $stmt->fetchAll();
    foreach($usersArr as $u) {
        if($u['admin'] === 1) {
            $admins[] = new Admin($u['id'], $u['email'], $u['username'], $u['password']);
        }
    }
    return $admins;
}

/**
 * Return an array of object with all clients in data base
 *
 * @return array -- Array of object Client
 * @throws PDOException
 */
function getDbClients(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM users");
    $usersArr = $stmt->fetchAll();
    foreach($usersArr as $u) {
        if($u['admin'] === 1) {
            $clients[] = new Admin($u['id'], $u['email'], $u['username'], $u['password']);
        }
    }
    return $clients;
}

/**
 * Return an array of object with all mushrooms in data base
 *
 * @return array -- Array of object Mushroom
 * @throws PDOException
 */
function getDbMushrooms(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM mushrooms");
    $mushroomsArr = $stmt->fetchAll();

    foreach($mushroomsArr as $m) {
        $mushrooms[] = new Mushroom($m['id'], $m['name'], $m['latin_name'], $m['genus'], $m['habitat'], $m['category'], $m['description'], $m['main_picture']);
    }
    return $mushrooms;
}