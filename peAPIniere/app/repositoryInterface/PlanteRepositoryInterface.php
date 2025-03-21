<?php

namespace App\RepositoryInterface;

use App\Models\Plante;

interface PlanteRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create( $data);
    public function update($id, $data);
    public function delete($id);
}
