<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskService
{
    private const LIST_ALL = 'list_tasks';

    public function listAll()
    {
        return CacheService::get(self::LIST_ALL) ?? CacheService::store(self::LIST_ALL ,Task::all());
    }

    public function getById(string $id)
    {
        return Task::findOrFail($id);
    }

    public function createOne(Request $request): Task
    {
        $data = $request->toArray();
        $data['author_id'] = $request->user()->id;
        $task = Task::create($data);
        CacheService::add(self::LIST_ALL, $task);
        
        return $task;
    }

    public function update(Request $request, Task $task): Task
    {
        $task->update($request->toArray());
        CacheService::edit(self::LIST_ALL, $task->refresh());

        return $task;
    }

    public function delete(Task $task): bool
    {
        CacheService::remove(self::LIST_ALL, $task);

        return $task->delete();
    }

    public function assigned(User $user)
    {
        return $user->tasks();
    }
    
    public function assign(Task $task, $assignedTo)
    {
        $task->update(['assigned_to' => $assignedTo]);

        CacheService::edit(self::LIST_ALL, $task->refresh());

        return $task;
    }
}