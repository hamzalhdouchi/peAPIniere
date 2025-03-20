<?php 
namespace App\Repositories;

use App\Models\categorie;
use App\Models\Category;
use App\RepositoryInterface\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function createCategory(array $data)
    {
        return categorie::create($data);
    }

    public function updateCategory($id, array $data)
    {
        $category = categorie::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = categorie::findOrFail($id);
        $category->delete();
        return true;
    }
}
