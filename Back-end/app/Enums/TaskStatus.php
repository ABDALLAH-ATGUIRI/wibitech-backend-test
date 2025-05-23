<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

class TaskStatus extends Enum
{
    const IN_PROGRESS = 'in_progress';
    const DONE = 'done';

    public static function getValues()
    {
        return [
            self::IN_PROGRESS,
            self::DONE,
        ];
    }
}