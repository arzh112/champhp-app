<?php
require_once __DIR__ . '/User.php';

class Admin extends User
{
    private int $adminId;

    // public function __construct(string $email, string $userName, string $password)
    // {
    //     parent::__construct($email, $userName, $password);
    // }

    public function addToBdd(): void
    {
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }
}
