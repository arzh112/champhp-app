<?php

class Picture
{
    private int $id;
    private string $title;
    private string $path;
    private string $date;
    private int $mushroomsId;
    private int $usersId;

    public function __construct(int $id, string $title, string $path, string $date, int $mushroomsId, int $usersId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->path = $path;
        $this->date = $date;
        $this->mushroomsId = $mushroomsId;
        $this->usersId = $usersId;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }
    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getMushroomsId(): int
    {
        return $this->mushroomsId;
    }
    public function setMushroomsId(int $mushroomsId): self
    {
        $this->mushroomsId = $mushroomsId;
        return $this;
    }

    public function getUsersId(): int
    {
        return $this->usersId;
    }
}
