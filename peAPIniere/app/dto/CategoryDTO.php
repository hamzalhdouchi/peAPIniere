<?php

namespace App\DTO;

class CategoryDTO
{
    public string $nom_Categorie;
    public string $description;

    public function __construct(array $data)
    {
        $this->nom_Categorie = $data['nom_Categorie'];
        $this->description = $data['description'];
    }

    public function toArray(): array
    {
        return [
            'nom_Categorie' => $this->nom_Categorie,
            'description' => $this->description,
        ];
    }
}
