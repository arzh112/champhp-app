<?php
require_once 'functions/db.php';
require_once 'classes/Mushroom.php';

try {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM mushrooms");
    $mushroomsArray = $stmt->fetchAll();
}catch (PDOException) {
    echo "erreur lors de la requête";
    exit;
}


if(isset($mushroomsArray)) {
    foreach($mushroomsArray as $m) {
        $mushrooms[] = new Mushroom($m['id'], $m['name'], $m['latin_name'], $m['genus'], $m['habitat'], $m['category'], $m['description']);
    }
}

var_dump($mushrooms);