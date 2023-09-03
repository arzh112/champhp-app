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
    $users = []; //return an empty array if db is empty
    foreach($usersArr as $u) {
        if($u['admin_status'] === 1) {
            $users[] = new Admin($u['id'], $u['email'], $u['username'], $u['password_hash'], $u['admin_status']);
        }
        if($u['admin_status'] === 0) {
            $users[] = new Client($u['id'], $u['email'], $u['username'], $u['password_hash'], $u['admin_status']);
        }
    } 
    return $users;
}

/**
 * Return an array of object with only the admins in data base
 *
 * @return array -- Array of objects Admin
 * @throws PDOException
 */
function getDbAdmins(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM users");
    $usersArr = $stmt->fetchAll();
    $admins = []; //return an empty array if db is empty
    foreach($usersArr as $u) {
        if($u['admin_status'] === 1) {
            $admins[] = new Admin($u['id'], $u['email'], $u['username'], $u['password_hash'], $u['admin_status']);
        }
    }
    return $admins;
}

/**
 * Return an array of object with only the clients in data base
 *
 * @return array -- Array of objects Client
 * @throws PDOException
 */
function getDbClients(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM users");
    $usersArr = $stmt->fetchAll();
    $clients = []; //return an empty array if db is empty
    foreach($usersArr as $u) {
        if($u['admin_status'] === 0) {
            $clients[] = new Client($u['id'], $u['email'], $u['username'], $u['password_hash'], $u['admin_status']);
        }
    }
    return $clients;
}

/**
 * Return an array of object with all mushrooms in data base
 *
 * @return array -- Array of objects Mushroom
 * @throws PDOException
 */
function getDbMushrooms(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM mushrooms");
    $mushroomsArr = $stmt->fetchAll();
    $mushrooms = [];
    foreach($mushroomsArr as $m) {
        $mushrooms[] = new Mushroom($m['id'], $m['name'], $m['latin_name'], $m['genus'], $m['habitat'], $m['category'], $m['description'], $m['main_picture']);
    }
    return $mushrooms;
}


/**
 * Get an array of all picture related to a mushroom
 *
 * @param integer - mushrooms id
 * @return array
 * @throws PDOException
 */
function getMushroomsPictures(int $mushroomsId): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM pictures WHERE mushrooms_id=$mushroomsId");
    $mushPicturesArr = $stmt->fetchAll();
    $mushPictures = [];
    foreach($mushPicturesArr as $p) {
        $mushPictures[] = new Picture($p['id'], $p['title'], $p['picture_path'], $p['upload_date'], $p['mushrooms_id'], $p['users_id']);
    }
    return $mushPictures;
}
 /**
  * Get an array of all users who uploaded a picture
  *
  * @return array - [['username' => value, 'picturesId' => value], ...]
  * @throws PDOException
  */
function getPicturesUsername(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT username, pictures.id AS picturesId FROM users INNER JOIN pictures ON users.id = users_id");  
    return $picturesUsername = $stmt->fetchAll();
}