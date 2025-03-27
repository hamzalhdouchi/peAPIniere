<?php

namespace Tests\Unit;

use App\Http\Controllers\PlantController;
use App\RepositoryInterface\PlanteRepositoryInterface;
use App\Http\Requests\PlantStorRequest;
use App\Http\Requests\PlantUpdateRequest;
use Mockery;
use Tests\TestCase;

class PlantTest extends TestCase
{
    protected $planteRepositoryMock;
    protected $plantController;

    
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->planteRepositoryMock = Mockery::mock(PlanteRepositoryInterface::class);
        $this->plantController = new PlantController($this->planteRepositoryMock);
    }

    // Test pour la création d'une plante
    public function test_store_plant()
    {
        $data = [
            'name' => 'Ficus',
            'description' => 'A small indoor plant',
            'category_id' => 1
        ];

        $request = Mockery::mock(PlantStorRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($data);

        $this->planteRepositoryMock->shouldReceive('create')->once()->with($data)->andReturn(['name' => 'Ficus', 'description' => 'A small indoor plant', 'category_id' => 1]);

        $response = $this->plantController->store($request);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'Plant created successfully']);
    }

    // Test pour la mise à jour d'une plante
    public function test_update_plant()
    {
        $data = [
            'name' => 'Ficus Updated',
            'description' => 'A bigger indoor plant',
            'category_id' => 1
        ];
        $id = 1;

        $request = Mockery::mock(PlantUpdateRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($data);

        $this->planteRepositoryMock->shouldReceive('update')->once()->with($id, $data)->andReturn($data);

        $response = $this->plantController->update($request, $id);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Plant updated successfully']);
    }

    // Test pour la suppression d'une plante
    public function test_destroy_plant()
    {
        $id = 1;

        $this->planteRepositoryMock->shouldReceive('delete')->once()->with($id)->andReturn(true);

        $response = $this->plantController->destroy($id);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Plant deleted successfully']);
    }

    // Test pour obtenir une plante par son slug
    public function test_show_plant_by_slug()
    {
        $slug = 'ficus';

        $this->planteRepositoryMock->shouldReceive('findPlante')->once()->with($slug)->andReturn(['slug' => 'ficus', 'name' => 'Ficus']);

        $response = $this->plantController->show($slug);

        $response->assertStatus(200);
        $response->assertJson(['slug' => 'ficus', 'name' => 'Ficus']);
    }

}
