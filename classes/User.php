<?php

abstract class User
{
    private int $id;
    protected string $email;
    protected string $username;
    protected string $password;

    public function __construct(string $email, string $username, string $password)
    {
        if (empty($email) || empty($username) || empty($password)) {
            throw new Exception("Tous les champs du formulaire sont obligatoires");
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException("L'adresse mail n'est pas valide");
        } else {
            $this->email = $email;
        }
        $this->username = $username;
        $this->password = $password;
    }

    public abstract function addToBdd() : void;

    public function getId(): string
    {
        return $this->id;
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
}
