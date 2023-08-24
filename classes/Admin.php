<?php
require_once 'classes/User.php';

class Admin extends User
{
    private int $adminId;

    public function __construct(string $email, string $userName, string $password)
    {
        parent::__construct($email, $userName, $password);
    }
}