<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\SearchRequest;
use App\Services\UserService;

class UserController extends ApiController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(SearchRequest $request)
    {
        return response()->json($this->userService->getByFillers($request->validated()), 200);
    }
}