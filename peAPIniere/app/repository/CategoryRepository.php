<?php 
namespace App\Repositories;

use App\Models\categorie;
use App\Models\Category;
use App\RepositoryInterface\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function createCategory(array $data)
    {
        categorie::create($data);
        return response().json(['message' => 'the categorie has been created']);
    }

    public function updateCategory($id, array $data)
    {
        $category = categorie::findOrFail($id);
        $category->update($data);
        return response().json(['messsage'=> 'the update is successfully'],200);
    }

    public function deleteCategory($id)
    {
        $category = categorie::findOrFail($id);
        $category->delete();
        return response().json(['message'=> 'the categorie is deleted successfully'],200);
    }

    public function getAllCategory()
    {
        $category = categorie::all();
        return response().json(['message'=> 'the categorie is recpere successfully','data' => $category],200)
    }
}
