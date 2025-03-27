<?php

namespace Tests\Unit;

use App\Http\Controllers\CommandeController;
use App\Repositories\CommandeRepositoryInterface;
use App\Http\Requests\commandStoreRequist;
use App\Http\Requests\commandUpdateRequist;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class CommandeTest extends TestCase
{
    protected $commandeRepositoryMock;
    protected $commandeController;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->commandeRepositoryMock = Mockery::mock(CommandeRepositoryInterface::class);
        $this->commandeController = new CommandeController($this->commandeRepositoryMock);
    }

    public function test_create_order()
    {
        $data = [
            'plants' => [
                ['slug' => 'plant1', 'quantity' => 10],
                ['slug' => 'plant2', 'quantity' => 5]
            ]
        ];

        $request = Mockery::mock(commandStoreRequist::class);
        $request->shouldReceive('validated')->once()->andReturn($data);
        
        $this->commandeRepositoryMock->shouldReceive('createOrder')->once()->with($data)->andReturn(['message' => 'the order is created successfully']);

        $response = $this->commandeController->create($request);

        $response->assertStatus(201);
        $response->assertJson(['message' => 'the order is created successfully']);
    }

    public function test_accept_order()
    {
        $orderId = 1;

        $this->commandeRepositoryMock->shouldReceive('acceptOrder')->once()->with($orderId)->andReturn(['message' => 'order is accepted']);

        $response = $this->commandeController->accept($orderId);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'order is accepted']);
    }

    public function test_reject_order()
    {
        $orderId = 1;

        $this->commandeRepositoryMock->shouldReceive('rejectOrder')->once()->with($orderId)->andReturn(['message' => 'order is rejected']);

        $response = $this->commandeController->reject($orderId);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'order is rejected']);
    }

    public function test_update_order_status()
    {
        $orderId = 1;
        $status = 'delivered';

        $request = Mockery::mock(commandUpdateRequist::class);
        $request->shouldReceive('validated')->once()->andReturn(['statut' => $status]);

        $this->commandeRepositoryMock->shouldReceive('updateOrderStatus')->once()->with($orderId, $status)->andReturn(['message' => 'the update is successfully']);

        $response = $this->commandeController->updateStatus($request, $orderId);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'the update is successfully']);
    }

    public function test_get_order_status()
    {
        $orderId = 1;
        $status = 'delivered';

        $this->commandeRepositoryMock->shouldReceive('getOrderStatus')->once()->with($orderId)->andReturn($status);

        $response = $this->commandeController->getStatus($orderId);

        $response->assertStatus(200);
        $response->assertJson(['order_id' => $orderId, 'statut' => $status]);
    }

    public function test_delete_order()
    {
        $orderId = 1;

        $this->commandeRepositoryMock->shouldReceive('distroy')->once()->with($orderId)->andReturn(true);

        $response = $this->commandeController->destroy($orderId);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Order deleted', 'success' => true]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
