<?php
namespace App\Http\Controllers;

use App\Http\Requests\PlantStorRequest;
use App\Http\Requests\PlantUpdateRequest;
use App\RepositoryInterface\PlanteRepositoryInterface;
use Illuminate\Http\Request;

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
     *     description="Fetches all plants. Optionally, you can search plants by a keyword.",
     *     operationId="getAllPlants",
     *     tags={"Plants"},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search for a plant",
     *         required=false,
     *         @OA\Schema(type="string", example="herb")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Plants found successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Plants found successfully."),
     *             @OA\Property(property="plantes", type="array", @OA\Items(type="object"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No plants found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No plants found.")
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        // Logic for fetching plants...
    }

    /**
     * @OA\Post(
     *     path="/api/plants",
     *     summary="Create a new plant",
     *     description="Creates a new plant.",
     *     operationId="createPlant",
     *     tags={"Plants"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description", "category_id"},
     *             @OA\Property(property="name", type="string", example="Rose", description="Name of the plant"),
     *             @OA\Property(property="description", type="string", example="A fragrant flower", description="Description of the plant"),
     *             @OA\Property(property="category_id", type="integer", example=1, description="ID of the plant category")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Plant created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Plant created successfully"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */
    public function store(PlantStorRequest $request)
    {
        // Logic for storing a plant...
    }

    /**
     * @OA\Get(
     *     path="/api/plants/{slug}",
     *     summary="Get plant details by slug",
     *     description="Fetch a plant by its slug.",
     *     operationId="getPlantBySlug",
     *     tags={"Plants"},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", example="rose")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Plant details retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Plant retrieved successfully."),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Plant not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Plant not found.")
     *         )
     *     )
     * )
     */
    public function show($slug)
    {
        // Logic for fetching a plant by slug...
    }

    /**
     * @OA\Put(
     *     path="/api/plants/{id}",
     *     summary="Update an existing plant",
     *     description="Updates the details of an existing plant.",
     *     operationId="updatePlant",
     *     tags={"Plants"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description", "category_id"},
     *             @OA\Property(property="name", type="string", example="Tulip", description="Name of the plant"),
     *             @OA\Property(property="description", type="string", example="A beautiful flower", description="Description of the plant"),
     *             @OA\Property(property="category_id", type="integer", example=2, description="Category of the plant")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Plant updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Plant updated successfully"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Plant not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Plant not found")
     *         )
     *     )
     * )
     */
    public function update(PlantUpdateRequest $request, $id)
    {
        // Logic for updating a plant...
    }

    /**
     * @OA\Delete(
     *     path="/api/plants/{id}",
     *     summary="Delete a plant",
     *     description="Deletes an existing plant.",
     *     operationId="deletePlant",
     *     tags={"Plants"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Plant deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Plant deleted successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Plant not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Plant not found")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        // Logic for deleting a plant...
    }
}
