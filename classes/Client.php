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
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$id]);
        $u = $stmt->fetch();
        return new self($u['id'], $u['email'], $u['username'], $u['password_hash'], $u['admin_status']);
    }
    
    /**
     * Static method for add a new user in data base
     *
     * @param PDO $pdo - Connection instance
     * @param string $email 
     * @param string $username
     * @param string $password
     * @return void
     * @throws InvalidEmailException - if invalid email format
     */
    public static function addToDB(PDO $pdo, string $email, string $username, string $password): void
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidEmailException("Le format de l'email est incorrect");
        }
        $stmt = $pdo->prepare("INSERT INTO users (email, username, password_hash, admin_status) VALUES (:email, :username, :passwordHash, false)");
        $stmt->execute([
            ':email' => $email,
            ':username' => $username,
            ':passwordHash' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }
    
}
