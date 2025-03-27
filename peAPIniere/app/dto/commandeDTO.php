<?php

namespace App\DTO;

class CommandeDTO
{
    public int $user_id;
    public int $plante_id;
    public int $quantity;
    public string $acciptaion;
    public string $statut;

    public function __construct(array $data)
    {
        $this->user_id = $data['user_id'] ;
        $this->plante_id = $data['plante_id'];
        $this->quantity = $data['quantity'];
        $this->acciptaion = $data['acciptaion'] ;
        $this->statut = $data['statut'];
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'plante_id' => $this->plante_id,
            'quantity' => $this->quantity,
            'acciptaion' => $this->acciptaion,
            'statut' => $this->statut,
        ];
    }
}
