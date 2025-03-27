<?php
namespace Tests\Unit;

use App\DTO\UserDTO;
use App\Http\Controllers\UserController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class UserTest extends TestCase
{
public function test_register_user()
{
    $userRepositoryMock = Mockery::mock(UserRepositoryInterface::class);
    $userRepositoryMock->shouldReceive('register')
        ->once()
        ->with([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
        ])
        ->andReturn(['message' => 'User registered', 'success' => true]);

    $controller = new UserController($userRepositoryMock);

    $request = Mockery::mock(UserStoreRequest::class);
    $request->shouldReceive('all')
        ->once()
        ->andReturn([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
        ]);

    $response = $controller->register($request);

    $this->assertEquals(201, $response->getStatusCode());
    $this->assertJsonStringEqualsJsonString(
        json_encode(['message' => 'User registered', 'success' => true]),
        $response->getContent()
    );
}

}