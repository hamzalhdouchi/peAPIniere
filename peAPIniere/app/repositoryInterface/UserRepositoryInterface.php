<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function register(array $data): User;
    public function login(array $credentials): ?string;
}
