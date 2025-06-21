<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Task\CreateUpdateRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Throwable;

class TaskController extends ApiController
{

    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $this->authorize('viewAny', Task::class);

        return response()->json($this->taskService->getPaginated(request()->all()), 200);
    }

    /**
     * Create a new task.
     *
     * @param  CreateUpdateRequest  $request
     * @return JsonResponse
     */
    public function create(CreateUpdateRequest $request)
    {
        $this->authorize('create', Task::class);
        try {
            return response()->json([
                "success" => true,
                "data" => $this->taskService->create($request->validated())
            ], 200);
        } catch (Throwable $th) {
            return response()->json(['success' => false, 'message' => "Something went wrong, please try again"], 500);
        }
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        try {
            return response()->json([
                "success" => $this->taskService->update($task->id, $request->validated())
            ], 200);
        } catch (Throwable $th) {
            return response()->json(['success' => false, 'message' => "Something went wrong, please try again"], 500);
        }
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        try {
            return response()->json([
                "success" => $this->taskService->delete($task->id),
            ], 200);
        } catch (Throwable $th) {
            return response()->json(['success' => false, 'message' => "Something went wrong, please try again"], 500);
        }
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        try {
            return response()->json([
                "success" => true,
                "data" => $this->taskService->getTask($task->id)
            ], 200);
        } catch (Throwable $th) {
            return response()->json(['success' => false, 'message' => "Something went wrong, please try again"], 500);
        }
    }
}