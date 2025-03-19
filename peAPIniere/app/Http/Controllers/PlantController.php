<?php

namespace App\Http\Controllers;

use App\Repositories\PlanteRepositoryInterface;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    protected $planteRepository;

    public function __construct(PlanteRepositoryInterface $planteRepository)
    {
        $this->planteRepository = $planteRepository;
    }

    public function index()
    {
        $plantes = $this->planteRepository->getAll();

        return response()->json([
            'success' => true,
            'data' => $plantes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomPlante' => 'required',
            'description' => 'required',
            'ptrc' => 'required|numeric',
            'images' => 'nullable|string',
        ]);

        $plante = $this->planteRepository->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Plante ajoutée avec succès',
            'data' => $plante
        ], 201);
    }

    public function show($id)
    {
        $plante = $this->planteRepository->getById($id);

        if (!$plante) {
            return response()->json([
                'success' => false,
                'message' => 'Plante non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $plante
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomPlante' => 'required',
            'description' => 'required',
            'ptrc' => 'required|numeric',
            'images' => 'nullable|string',
        ]);

        $plante = $this->planteRepository->update($id, $request->all());

        if (!$plante) {
            return response()->json([
                'success' => false,
                'message' => 'Plante non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Plante mise à jour avec succès',
            'data' => $plante
        ]);
    }

    public function destroy($id)
    {
        $deleted = $this->planteRepository->delete($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Plante non trouvée'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Plante supprimée avec succès'
        ]);
    }
}
