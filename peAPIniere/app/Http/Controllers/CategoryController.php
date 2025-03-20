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
        echo app()->version();
    }

    /**
     * @OA/Post(
     * path="/api/Categorie",
     * summery="create categorie",
     * description="creation de categorie avec son nome et desciption",
     * tage="Categorie",
     * @OA/RequestBody(
     * required="True"
     * @OA/JsonContent(
     * required={"nome_categorie","desciption"}
     * @OA/property(property="name_categorie",type="string",exemple="artomatique")
     * @OA/property(property="description",type="string",exemple="the categorie")
     * 
     * )
     * )
     * 
     * )
     * 
     */
    public function create(CategorieRequest $request)
    {
        
        $category = $this->categoryRepository->createCategory($request->all());

        return response()->json($category, 201);
    }


    public function index()
    {
        // dd(1);
        $categorie = categorie::all();
        return $categorie;
    }
  
    public function update($id, CategorieUpdateRequest $request)
    {
    

        $category = $this->categoryRepository->updateCategory($id, $request->all());

        return response()->json($category);
    }

    public function delete($id)
    {
        $this->categoryRepository->deleteCategory($id);

        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
