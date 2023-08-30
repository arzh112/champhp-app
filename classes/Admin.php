<?php
require_once __DIR__ . '/User.php';

class Admin extends User
{
    private int $adminId;

    public function getAdminId(): int
    {
        return $this->adminId;
    }
}
