<?php

namespace App\DTO;

use Ramsey\Uuid\Type\Integer;

class UserDTO
{
    public string $name;
    public string $email;
    private string $password; 

    public int $role_id;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? ''; 
        $this->role_id = $data['role_id'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id
        ];
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
