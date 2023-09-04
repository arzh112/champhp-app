<?php
require_once 'classes/IgetData.php';
require_once 'classes/IgetDataById.php';

abstract class User implements IgetData, IgetDataById
{
    protected int $id;
    protected string $email;
    protected string $username;
    protected string $password;
    protected bool $adminStatus;

    public function __construct(int $id, string $email, string $username, string $password, bool $adminStatus)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->adminStatus = $adminStatus;
    }

    public function getId(): string
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getAdminStatus(){ return $this->adminStatus; }
    public function setAdminStatus($adminStatus): self { $this->adminStatus = $adminStatus; return $this; }
}
