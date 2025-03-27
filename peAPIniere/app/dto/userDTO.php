<?php

namespace App\DTO;

class UserDTO
{
    public string $name;
    public string $email;
    private string $password; 

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? ''; 
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
