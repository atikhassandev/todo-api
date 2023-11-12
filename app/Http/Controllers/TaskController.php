<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

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
    public function show(Task $task)
    {
        return new ApiSuccessResponse('Task successfully retrieved.', ['record' => new TaskResource($task)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {

        $data = $request->validated();

        if ($request->hasFile('image')) {

            if ($task->image) {
                $this->taskService->deleteUploadedImage($task->image);
            }

            $path = $this->taskService->uploadImage($request);

            if ($path === false) {
                return new ApiErrorResponse('Failed to upload image.', [], Response::HTTP_BAD_REQUEST);
            }

            $data['image'] = $path;
        }

        $task->update($data);

        return new ApiSuccessResponse('Task successfully updated.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if($task->image){
            $this->taskService->deleteUploadedImage($task->image);
        }

        $task->delete();

        return new ApiSuccessResponse('Task successfully deleted', [], 201);
    }

    /**
     * Filter tasks by status
     */
    public function filterByStatus($taskStatus)
    {
     
        $tasks = Task::where('status', $taskStatus)->paginate(10);

        $responseData = [
            'totalRecords' => $tasks->total(),
            'limit' => $tasks->perPage(),
            'page' => $tasks->currentPage(),
            'records' => TaskResource::collection($tasks->items()),
        ];

        return new ApiSuccessResponse('Filtering of records completed successfully', $responseData);
        
    }

    /**
     * Update the status of a task.
     */
    public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        
        $status = $request->validate([
            'status' => ['required', Rule::enum(TaskStatus::class)],
        ]);

        $task->update($status);

        return new ApiSuccessResponse('Successfully updated task status');

    }
}
