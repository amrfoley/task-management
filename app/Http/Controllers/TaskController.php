<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\TaskService;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UpdateAssignedToTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Task::class);

        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        Gate::authorize('create', Task::class);

        $task = (new TaskService())->createOne($request);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        Gate::authorize('view', $task);

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if ($request->user()->cannot('update', $task)) {
            abort(403);
        }

        $task = (new TaskService())->update($request, $task);

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        if ($request->user()->cannot('delete', $task)) {
            abort(403);
        }

        $deleted = (new TaskService())->delete($task);

        return response($deleted? 'Task deleted!' : 'Failed to delete!');
    }

    public function assigned(Request $request)
    {
        if ($request->user()->cannot('showAssigned', $task)) {
            abort(403);
        }

        $tasks = (new TaskService())->assigned($request->user());

        return TaskResource::collection($tasks);
    }

    public function assign(UpdateAssignedToTaskRequest $request, Task $task)
    {
        if (Gate::allows('assign', $task)) {
            abort(403);
        }

        $task = (new TaskService())->assign($task, $request->input('assigned_to'));

        return new TaskResource($task);
    }
}
