<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantStorRequest;
use App\Http\Requests\PlantUpdateRequest;
use App\RepositoryInterface\PlanteRepositoryInterface;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Plants",
 *     description="Endpoints for managing plants"
 * )
 */
class PlantController extends Controller
{
    protected $planteRepository;

    public function __construct(PlanteRepositoryInterface $planteRepository)
    {
        $this->planteRepository = $planteRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/plants",
     *     summary="Get all plants",
     *     tags={"Plants"},
     *     @OA\Parameter(name="search", in="query", @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=404, description="No plants found")
     * )
     */
    public function index(Request $request)
    {
         
        if (!$request->has('search')) {
            $plants = $this->planteRepository->getAllPlantes();
        }
        $data  = $request->all()
        $plants = $this->planteRepository->searchPlantes($request);
        return response()->json($plants, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/plants",
     *     summary="Create a plant",
     *     tags={"Plants"},
     *     @OA\RequestBody(@OA\JsonContent(
     *         required={"name", "description", "category_id"},
     *         @OA\Property(property="name", type="string"),
     *         @OA\Property(property="description", type="string"),
     *         @OA\Property(property="category_id", type="integer")
     *     )),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(PlantStorRequest $request)
    {
        $plant = $this->planteRepository->create($request->validated());
        return response()->json(['message' => 'Plant created successfully', 'data' => $plant], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/plants/{slug}",
     *     summary="Get plant by slug",
     *     tags={"Plants"},
     *     @OA\Parameter(name="slug", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Success"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($slug)
    {
        $plant = $this->planteRepository->findPlante($slug);
        if (!$plant) {
            response()->json(['message' => 'Plant not found'], 404);
        }
        return response()->json($plant, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/plants/{id}",
     *     summary="Update a plant",
     *     tags={"Plants"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(@OA\JsonContent(
     *         required={"name", "description", "category_id"},
     *         @OA\Property(property="name", type="string"),
     *         @OA\Property(property="description", type="string"),
     *         @OA\Property(property="category_id", type="integer")
     *     )),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(PlantUpdateRequest $request, $id)
    {
        $plant = $this->planteRepository->update($id, $request);
        return response()->json(['message' => 'Plant updated successfully', 'data' => $plant], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/plants/{id}",
     *     summary="Delete a plant",
     *     tags={"Plants"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $this->planteRepository->delete($id);
        return response()->json(['message' => 'Plant deleted successfully'], 200);
    }
}
