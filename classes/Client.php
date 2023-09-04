<?php
require_once __DIR__ . '/User.php';

class Client extends User
{
    // private int $clientId;

    // public function getClientId(): int { return $this->clientId; }

    public static function getData(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM users");
        $usersArr = $stmt->fetchAll();
        $clients = []; //return an empty array if db is empty
        foreach ($usersArr as $u) {
            if ($u['admin_status'] === 0) {
                $clients[] = new Client($u['id'], $u['email'], $u['username'], $u['password_hash'], $u['admin_status']);
            }
        }
        return $clients;
    }

    public static function getDataById(PDO $pdo, int $id): object
    {
        $stmt = $pdo->query("SELECT * FROM users WHERE id=$id");
        $u = $stmt->fetch();
        return new self($u['id'], $u['email'], $u['username'], $u['password_hash'], $u['admin_status']);
    } 

}
