<?php

namespace App\DTO;

class PlantDTO
{
    public string $slug;
    public string $nomPlante;
    public string $description;
    public float $ptrc;
    public ?string $images;

    public function __construct(array $data)
    {
        $this->slug = $data['slug'] ;
        $this->nomPlante = $data['nomPlante'];
        $this->description = $data['description'];
        $this->ptrc = $data['ptrc'];
        $this->images = $data['images'];
    }

    public function toArray(): array
    {
        return [
            'slug' => $this->slug,
            'nomPlante' => $this->nomPlante,
            'description' => $this->description,
            'ptrc' => $this->ptrc,
            'images' => $this->images,
        ];
    }
}
