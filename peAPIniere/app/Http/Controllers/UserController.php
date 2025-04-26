<?php

namespace App\Http\Controllers;

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
    public function register(UserStoreRequest $request): JsonResponse
    {
        try {
            $user = $this->userRepository->register($request->validated());
            return response()->json(['message' => 'User registered', 'data' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        $authData = $this->userRepository->login($request->validated());
        if (!$authData) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['message' => 'Login successful', 'user' => $authData['user'], 'token' => $authData['token']]);
    }
}
