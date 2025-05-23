<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService extends BaseService
{
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getPaginated(array $data)
    {
        if (auth()->user()->isUser()) {
            $data["user_id"] = auth()->user()->id;
        }

        return $this->taskRepository->getPaginated($data);
    }

    public function create(array $data)
    {
        return $this->taskRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->taskRepository->delete($id);
    }

    public function getTask(int $id)
    {
        return $this->taskRepository->find($id);
    }

    public function updateTask(int $id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }
}