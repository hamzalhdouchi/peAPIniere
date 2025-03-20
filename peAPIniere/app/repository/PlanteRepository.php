<?php 


namespace App\repository;

use App\Models\plant;
use App\RepositoryInterface\PlanteRepositoryInterface;

class PlanteRepository implements PlanteRepositoryInterface
{

    public function getAllPlantes()
    {
        return Plant::all();
    }

    public function searchPlantes($search)
    {
        return Plant::where('name', 'ILIKE', '%' . $search['search'] . '%')->get();
    }

    public function findPlante($slug)
    {
        return Plant::where('slug', $slug)->first();
    }


    public function getAll()
    {
        return Plant::all();
    }

    public function getById($id)
    {
        return plant::findOrFail($id);
    }

    public function create( $data)
    {
        return Plant::create($data);
    }

    public function update($id,  $data)
    {
        $plante = Plant::findOrFail($id);
        
        $plante->update($data);
        return $plante;
    }

    public function delete($id)
    {
        $plante = Plant::find($id);
        $plante->delete();
    }
}
