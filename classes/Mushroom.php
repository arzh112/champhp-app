<?php


class Mushroom implements IgetData, IgetDataById
{
    private int $id;
    private string $name;
    private string $latinName;
    private string $genus;
    private string $habitat;
    private string $category;
    private string $description;
    private string $mainPicture;

    public function __construct($id, $name, $latinName, $genus, $habitat, $category, $description, $mainPicture)
    {
        $this->id = $id;
        $this->name = $name;
        $this->latinName = $latinName;
        $this->genus = $genus;
        $this->habitat = $habitat;
        $this->category = $category;
        $this->description = $description;
        $this->mainPicture = $mainPicture;
    }

    public static function getData(PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM mushrooms");
        $mushroomsArr = $stmt->fetchAll();
        $mushrooms = [];
        foreach ($mushroomsArr as $m) {
            $mushrooms[] = new self($m['id'], $m['name'], $m['latin_name'], $m['genus'], $m['habitat'], $m['category'], $m['description'], $m['main_picture']);
        }
        return $mushrooms;
    }

    /**
     * Undocumented function
     *
     * @param PDO $pdo
     * @param integer $id
     * @return object
     */
    public static function getDataById(PDO $pdo, int $id): object
    {
        $stmt = $pdo->query("SELECT * FROM mushrooms WHERE id=$id");
        $m = $stmt->fetch();
        return new self($m['id'], $m['name'], $m['latin_name'], $m['genus'], $m['habitat'], $m['category'], $m['description'], $m['main_picture']);
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

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getLatinName(): string
    {
        return $this->latinName;
    }
    public function setLatinName(string $latinName): self
    {
        $this->latinName = $latinName;
        return $this;
    }

    public function getGenus(): string
    {
        return $this->genus;
    }
    public function setGenus(string $genus): self
    {
        $this->genus = $genus;
        return $this;
    }

    public function getHabitat(): string
    {
        return $this->habitat;
    }
    public function setHabitat(string $habitat): self
    {
        $this->habitat = $habitat;
        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }
    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getMainPicture(): string
    {
        return $this->mainPicture;
    }
    public function setMainPicture(string $mainPicture): self
    {
        $this->mainPicture = $mainPicture;
        return $this;
    }
}
