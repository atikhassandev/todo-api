<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

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
