<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends BaseRepository
{
    /**
     * Summary of __construct
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        parent::__construct($task);
    }
}