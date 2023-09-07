<?php
require_once __DIR__ . '/User.php';

class Admin extends User
{
    // private int $adminId;

    // public function getAdminId(): int
    // {
    //     return $this->adminId;
    // }

    public static function getData(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM users");
        $usersArr = $stmt->fetchAll();
        $users = []; //return an empty array if db is empty
        foreach ($usersArr as $u) {
            if ($u['admin_status'] === 1) {
                $users[] = new self($u['id'], $u['email'], $u['username'], $u['password_hash'], $u['admin_status']);
            }
        }
        return $users;
    }

    public static function getDataById(PDO $pdo, int $id): object
    {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$id]);
        $u = $stmt->fetch();
        return new self($u['id'], $u['email'], $u['username'], $u['password_hash'], $u['admin_status']);
    } 
}
