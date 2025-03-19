<?php 


namespace App\Repositories;

use App\Models\plant;

class PlanteRepository implements PlanteRepositoryInterface
{
    public function getAll()
    {
        return Plant::all();
    }

    public function getById($id)
    {
        return plant::findOrFail($id);
    }

    public function create(array $data)
    {
        return Plant::create($data);
    }

    public function update($id, array $data)
    {
        $plante = Plant::findOrFail($id);
        $plante->update($data);
        return $plante;
    }

    public function delete($id)
    {
        $plante = Plant::findOrFail($id);
        $plante->delete();
    }
}
