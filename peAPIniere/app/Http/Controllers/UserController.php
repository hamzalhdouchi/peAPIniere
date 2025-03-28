<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     tags={"User"},
     *     @OA\RequestBody(@OA\JsonContent(
     *         required={"name", "email", "password"},
     *         @OA\Property(property="name", type="string"),
     *         @OA\Property(property="email", type="string"),
     *         @OA\Property(property="password", type="string")
     *     )),
     *     @OA\Response(response=201, description="User registered"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function register(UserStoreRequest $request)
    {
        $userDTO = new UserDTO($request->all());
        $result = $this->userRepository->register(['name' => $userDTO->name,'email' => $userDTO->email,'password' => $userDTO->getPassword(), 'role_id' => $userDTO->role_id]);

        return response()->json($result, 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="User login",
     *     tags={"User"},
     *     @OA\RequestBody(@OA\JsonContent(
     *         required={"email", "password"},
     *         @OA\Property(property="email", type="string"),
     *         @OA\Property(property="password", type="string")
     *     )),
     *     @OA\Response(response=200, description="Login successful"),
     *     @OA\Response(response=401, description="Invalid credentials")
     * )
     */
    public function login(LoginRequest $request)
    {
        $authData = $this->userRepository->login($request); 
    
        if (!$authData) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    
        return response()->json([
            'message' => 'Login successful',
            'user' => $authData['user'],
            'token' => $authData['token']
        ]);
    }
}
