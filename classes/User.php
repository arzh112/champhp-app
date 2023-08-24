<?php

class User
{
    private int $id;
    private string $userName;
    private string $email;
    private string $password;

    public function __construct(string $userName, string $email, string $password)
    {
        $this->userName = $userName;
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException("L'adresse mail n'est pas valide");
        } else {
            $this->email = $email;
        }
        $this->password = $password;
    }

    public function getId(): string
    {
        return $this->id;
    }
    public function setId(string $id): self
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

    public function getUserName(): string
    {
        return $this->userName;
    }
    public function setUserName(string $userName): self
    {
        $this->userName = $userName;
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
}
