<?php

namespace App\Services;

use App\Http\Resources\AuthenticationResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{

    /** @var UserRepository $userRepository */
    private $userRepository;

    /**
     * Summary of __construct
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getByFillers(array $fillers = []): Collection
    {
        return $this->userRepository->search(collect($fillers))->get();
    }

    /**
     * Summary of register
     * @param array $data
     * @return User|null
     */
    public function register(array $data): ?User
    {
        $user = $this->userRepository->create([
            'username' => strtolower($data['username']),
            'first_name' => strtolower($data['first_name']),
            'last_name' => strtolower($data['last_name']),
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        return $user?->fresh();
    }

    /**
     * Generate a token cookie and return a success response with user data.
     * @param User $user
     * @param int $expiresIn
     * @return JsonResponse
     */
    public function respondWithToken(User $user, int $expiresIn = 60): JsonResponse
    {
        $token = $user->createToken('appToken')->plainTextToken;

        $cookie = createTokenCookie($token, $expiresIn);

        return response()->json([
            'success' => true,
            'user' => new AuthenticationResource($user),
        ], 200)->withCookie($cookie);
    }
}
