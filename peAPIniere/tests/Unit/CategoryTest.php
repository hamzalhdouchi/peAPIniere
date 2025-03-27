<?php

namespace Tests\Unit;

use App\Http\Controllers\CategoryController;
use App\DTO\CategoryDTO;
use App\Http\Requests\CategorieUpdateRequest;
use App\RepositoryInterface\CategoryRepositoryInterface;
use App\Http\Requests\CategorieRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected $categoryRepositoryMock;
    protected $categoryController;

    public function setUp(): void
    {
        parent::setUp();

        $this->categoryRepositoryMock = Mockery::mock(CategoryRepositoryInterface::class);
        $this->categoryController = new CategoryController($this->categoryRepositoryMock);
    }

    public function it_can_create_a_category()
    {
        $data = [
            'nom_Categorie' => 'Category Test',
            'description' => 'Test description for category'
        ];

        $this->categoryRepositoryMock->shouldReceive('createCategory')->once()->with($data)->andReturn($data);

        $request = Mockery::mock(CategorieRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($data);

        $response = $this->categoryController->create($request);

        $response->assertStatus(201);
        $response->assertJson($data);
    }

    /** @test */
    public function it_can_get_all_categories()
    {
        $categories = [
            ['nom_Categorie' => 'Category 1', 'description' => 'Description 1'],
            ['nom_Categorie' => 'Category 2', 'description' => 'Description 2']
        ];

        $this->categoryRepositoryMock
            ->shouldReceive('getAllCategory')
            ->once()
            ->andReturn($categories);

        $response = $this->categoryController->index(new \Illuminate\Http\Request());

        $response->assertStatus(200);
        $response->assertJson($categories);
    }

    /** @test */
    public function it_can_update_a_category()
    {
        $categoryId = 1;
        $updatedData = [
            'nom_Categorie' => 'Updated Category',
            'description' => 'Updated Description'
        ];

        $this->categoryRepositoryMock
            ->shouldReceive('updateCategory')
            ->once()
            ->with($categoryId, $updatedData)
            ->andReturn($updatedData);

        $request = Mockery::mock(CategorieUpdateRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($updatedData);

        $response = $this->categoryController->update($categoryId, $request);

        $response->assertStatus(200);
        $response->assertJson($updatedData);
    }

    /** @test */
    public function it_can_delete_a_category()
    {
        $categoryId = 1;

        $this->categoryRepositoryMock
            ->shouldReceive('deleteCategory')
            ->once()
            ->with($categoryId)
            ->andReturn(true);

        $response = $this->categoryController->delete($categoryId);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
