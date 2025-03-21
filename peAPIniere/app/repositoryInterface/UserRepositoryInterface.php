<?php

namespace App\RepositoryInterface;

interface UserRepositoryInterface
{
    public function register($data);
    public function login($credentials);
}
