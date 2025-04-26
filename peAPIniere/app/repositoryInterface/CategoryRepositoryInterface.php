<?php
namespace App\RepositoryInterface;

interface CategoryRepositoryInterface
{
    public function createCategory(array $data);
    public function updateCategory($id, array $data);
    public function deleteCategory($id);
    public function getAllCategory();
}
