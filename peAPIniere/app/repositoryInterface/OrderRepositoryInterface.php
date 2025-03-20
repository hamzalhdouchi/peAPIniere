<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function getSalesStats(): array;

    public function getTopPlants(): Collection;

    public function getSalesByCategory(): Collection;
}
