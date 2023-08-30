<?php

class Mushroom
{
    private int $id;
    private string $name;
    private string $latinName;
    private string $genus;
    private string $habitat;
    private string $category;
    private string $description;

    public function __construct($id, $name, $latinName, $genus, $habitat, $category, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->latinName = $latinName;
        $this->genus = $genus;
        $this->habitat = $habitat;
        $this->category = $category;
        $this->description = $description;
    }
}