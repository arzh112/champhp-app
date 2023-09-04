<?php

class Picture implements IgetData, IgetDataById
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

    public static function getData(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM pictures");
        $picturesArr = $stmt->fetchAll();
        $pictures = [];
        foreach ($picturesArr as $p) {
            $pictures[] = new self($p['id'], $p['title'], $p['picture_path'], $p['upload_date'], $p['mushrooms_id'], $p['users_id']);
        }
        return $pictures;
    }

    public static function getDataById(PDO $pdo, int $id): object
    {
        $stmt = $pdo->query("SELECT * FROM pictures WHERE id=$id");
        $p = $stmt->fetch();
        return new self($p['id'], $p['title'], $p['picture_path'], $p['upload_date'], $p['mushrooms_id'], $p['users_id']);
    }

    public static function getPicturesByMushroomsId(PDO $pdo, int $mushroomsId): array
    {
        $stmt = $pdo->query("SELECT * FROM pictures WHERE mushrooms_id=$mushroomsId");
        $picturesArr = $stmt->fetchAll();
        $pictures = [];
        foreach ($picturesArr as $p) {
            $pictures[] = new self($p['id'], $p['title'], $p['picture_path'], $p['upload_date'], $p['mushrooms_id'], $p['users_id']);
        }
        return $pictures;
    }

    function getPicturesUsername(PDO $pdo): string
    {
        $picturesId = $this->id;
        $stmt = $pdo->query("SELECT username FROM users INNER JOIN pictures ON users.id = users_id WHERE pictures.id=$picturesId");
        $usernameArr = $stmt->fetch();
        return $usernameArr['username'];
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
