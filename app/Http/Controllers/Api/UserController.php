<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        return response()->json([
            "data" => $this->userService->getByFillers()
        ]);
    }
}