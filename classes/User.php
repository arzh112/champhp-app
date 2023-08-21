<?php

class User
{
    private string $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $userName;
    private string $password;

    public function __construct(string $firstName, string $lastName, string $email, string $userName, string $password)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException(ErrorCode::getErrorMessage(ErrorCode::INVALID_EMAIL));
        } else {
            $this->email = $email;
        }
        $this->userName = $userName;
        $this->password = $password;
    }

    public function isValidEmail() : bool {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    public function addUserIntoData(): void {
        
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

    public function getLastName(): string
    {
        return $this->lastName;
    }
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
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
