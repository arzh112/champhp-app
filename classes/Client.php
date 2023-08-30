<?php
require_once __DIR__ . '/User.php';

class Client extends User
{
    private int $clientId;

    public function getClientId(): int { return $this->clientId; }
}
