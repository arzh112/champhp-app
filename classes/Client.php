<?php
require_once __DIR__ . '/User.php';

class Client extends User
{
    private int $clientId;

    // public function __construct(string $email, string $userName, string $password)
    // {
    //     parent::__construct($email, $userName, $password);
    // }
    public function addToBdd(): void
    {
        
    }

    public function getClientId(): int { return $this->clientId; }
}
