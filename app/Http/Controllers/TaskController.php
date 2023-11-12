<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(10);

        $responseData = [
            'totalRecords' => $tasks->total(),
            'limit' => $tasks->perPage(),
            'page' => $tasks->currentPage(),
            'records' => TaskResource::collection($tasks->items()),
        ];

        return new ApiSuccessResponse('Retrieve records successfully', $responseData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $request->validated();
        

        if ($request->hasFile('image')) {
            $path = $this->taskService->uploadImage($request);

            if ($path === false) {
                return new ApiErrorResponse('Failed to upload image', [], Response::HTTP_BAD_REQUEST);
            }

            $task['image'] = $path;
        }   

        $task = Task::create($task);

        return new ApiSuccessResponse('Task successfully created.', ['record' => new TaskResource($task)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Filter tasks by status
     */
    public function filterByStatus($taskStatus)
    {
        //
    }

    /**
     * Update the status of a task.
     */
    public function updateStatus(Request $request, $id)
    {
        //
    }
}
