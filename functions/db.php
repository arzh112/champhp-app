<?php

function getDbConnection(): PDO
{
    $pdo = new PDO(
        "mysql:host=host.docker.internal;port=3306;dbname=champhp-db;charset=utf8mb4", 
        "root", 
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    return $pdo;
}

function getUsers(): array {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM users");
    return $stmt->fetchAll();
}