<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Summary of __construct
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}