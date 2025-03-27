<?php 


namespace App\repository;

use App\Models\plant;
use App\RepositoryInterface\PlanteRepositoryInterface;

class PlanteRepository implements PlanteRepositoryInterface
{

    public function getAllPlantes()
    {
        $plant = Plant::all();
        return $plant;
    }

    public function searchPlantes($search)
    {
        $plant = Plant::where('name', 'ILIKE', '%' . $search['search'] . '%')->get();
        return $plant;
    }

    public function findPlante($slug)
    {
        $plant = Plant::where('slug', $slug)->first();
        return $plant;
    }


    public function getAll()
    {
        $allPlant = Plant::all();
        return $allPlant;
    }

    public function getById($id)
    {
        $getplant = plant::findOrFail($id);
        return $getplant;
    }

    public function create( $data)
    {
        $plant = Plant::create($data);
        return $plant;
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

        return response()->json(['message' => 'the plant is delete successfully'],200);
    }
}
