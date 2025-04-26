<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieRequest;
use App\Http\Requests\CategorieUpdateRequest;
use App\Models\categorie;
use App\RepositoryInterface\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/categories",
     *     summary="Create a category",
     *     tags={"Categories"},
     *     @OA\RequestBody(@OA\JsonContent(
     *         required={"name_categorie", "description"},
     *         @OA\Property(property="name_categorie", type="string"),
     *         @OA\Property(property="description", type="string")
     *     )),
     *     @OA\Response(response=201, description="Category created")
     * )
     */
    public function create(CategorieRequest $request)
    {
        $data = $request->all()
        $category = $this->categoryRepository->createCategory($data);
        return response()->json($category, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Get all categories",
     *     tags={"Categories"},
     *     @OA\Response(response=200, description="List of categories")
     * )
     */
    public function index()
    {
        $category = $this->categoryRepository->getAllCategory();
        return;
    }

    /**
     * @OA\Put(
     *     path="/api/categories/{id}",
     *     summary="Update a category",
     *     tags={"Categories"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(@OA\JsonContent(
     *         required={"name_categorie", "description"},
     *         @OA\Property(property="name_categorie", type="string"),
     *         @OA\Property(property="description", type="string")
     *     )),
     *     @OA\Response(response=200, description="Category updated")
     * )
     */
    public function update($id, CategorieUpdateRequest $request)
    {
        $data = $request;
        $category = $this->categoryRepository->updateCategory($id, $data);
        return response()->json($category);
    }

    /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     summary="Delete a category",
     *     tags={"Categories"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Category deleted")
     * )
     */
    public function delete($id)
    {
        $this->categoryRepository->deleteCategory($id);
        return response()->json(['message' => 'Category deleted.']);
    }
}
