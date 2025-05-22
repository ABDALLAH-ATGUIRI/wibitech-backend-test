<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class UserRole extends Enum
{
    const ADMIN = 'admin';
    const USER = 'user';
}