<?php

class Picture implements IgetData, IgetDataById
{
    private int $id;
    private string $title;
    private string $path;
    private string $type;
    private string $date;
    private int $mushroomsId;
    private int $usersId;

    public function __construct(int $id, string $title, string $path, string $type, string $date, int $mushroomsId, int $usersId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->path = $path;
        $this->type = $type;
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
            $pictures[] = new self($p['id'], $p['title'], $p['picture_path'], $p['type'], $p['upload_date'], $p['mushrooms_id'], $p['users_id']);
        }
        return $pictures;
    }

    public static function getDataById(PDO $pdo, int $id): object
    {
        $stmt = $pdo->prepare("SELECT * FROM pictures WHERE id=?");
        $stmt->execute([$id]);
        $p = $stmt->fetch();
        return new self($p['id'], $p['title'], $p['picture_path'], $p['type'], $p['upload_date'], $p['mushrooms_id'], $p['users_id']);
    }

    public static function getPicturesByMushroomsId(PDO $pdo, int $mushroomsId): array
    {
        $stmt = $pdo->prepare("SELECT * FROM pictures WHERE mushrooms_id=?");
        $stmt->execute([$mushroomsId]);
        $picturesArr = $stmt->fetchAll();
        $pictures = [];
        foreach ($picturesArr as $p) {
            $pictures[] = new self($p['id'], $p['title'], $p['picture_path'], $p['type'], $p['upload_date'], $p['mushrooms_id'], $p['users_id']);
        }
        return $pictures;
    }

    public static function getUsersPictures(PDO $pdo, int $usersId): array
    {
        $stmt = $pdo->prepare("SELECT * FROM pictures WHERE users_id=?");
        $stmt->execute([$usersId]);
        $picturesArr = $stmt->fetchAll();
        $pictures = [];
        foreach ($picturesArr as $p) {
            $pictures[] = new self($p['id'], $p['title'], $p['picture_path'], $p['type'], $p['upload_date'], $p['mushrooms_id'], $p['users_id']);
        }
        return $pictures;
    }

    public static function addToDB(PDO $pdo, string $name, string $path, string $type, string $size, int $mushroomsId, int $usersId): void
    {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO pictures (title, picture_path, type, size, mushrooms_id, users_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $name,
            $path,
            $type,
            $size,
            $mushroomsId,
            $usersId
        ]);
    }

    // public static function addToDirectory($file, $destination): void
    // {
    //     if (isset($_FILES['newPicture'])) {
    //         $file = $_FILES['newPicture'];
    //         $destination = "assets/uploads/" . $path;
    //         if(move_uploaded_file($file['tmp_name'], $destination) === false) {
    //             throw new Exception("l'ajout de la photo au dossier de destination à échoué");
    //         }
    //         if (move_uploaded_file($file['tmp_name'], $destination)) {
    //             Utils::redirect('mushrooms-details.php?id=' . $_POST['mushroomsId'] . '&message=La photo est enregistrée');
    //         }
    //     }
    // }

    public static function deletePicture(PDO $pdo, int $picturesId): void
    {
        $delete = $pdo->prepare("DELETE FROM pictures WHERE id=?");
        $delete->execute([$picturesId]);
    }

    public function getPicturesUsername(PDO $pdo): string
    {
        $picturesId = $this->id;
        $stmt = $pdo->prepare("SELECT username FROM users INNER JOIN pictures ON users.id = users_id WHERE pictures.id=:picturesId");
        $stmt->execute(['picturesId' => $picturesId]);
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
