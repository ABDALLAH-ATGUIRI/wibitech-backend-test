<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\AuthenticationResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthenticationController extends ApiController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Register a new user and log them in.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->register($request->validated());

            if (!Auth::attempt($request->only('username', 'password'))) {
                throw new AuthenticationException('Authentication failed after registration.');
            }

            return $this->userService->respondWithToken($user);
        } catch (AuthenticationException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 401);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => "An error occurred during registration."], 500);
        }
    }

    /**
     * Log in an existing user.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            if (!Auth::attempt($request->validated())) {
                throw new AuthenticationException('Invalid login credentials.');
            }

            $expiresIn = $request->remember_me ? 60 * 24 * 30 : 60; // 30 days if remembered, else 1 hour;

            return $this->userService->respondWithToken(Auth::user(), $expiresIn);
        } catch (AuthenticationException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 401);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => "An error occurred during login."], 500);
        }
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user) {
            $user->token()->revoke();
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
            ], 200);
        }

        return response()->json(['success' => false, 'message' => "No authenticated user found."], 401);
    }

    /**
     * Get the authenticated user's information.
     */
    public function me(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully retrieved user data.',
                'user' => new AuthenticationResource($user)
            ], 200);
        }

        return response()->json(['success' => false, 'message' => "No authenticated user found."], 401);
    }
}
