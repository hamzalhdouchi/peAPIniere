<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function getSalesStats();

    public function getTopPlants();

    public function getSalesByCategory();
}
