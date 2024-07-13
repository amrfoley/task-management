<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskService
{   
    public function getById(string $id)
    {
        return Task::findOrFail($id);
    }

    public function createOne(Request $request): Task
    {
        $data = $request->toArray();
        $data['author_id'] = $request->user()->id;
        
        return Task::create($data);
    }

    public function update(Request $request, Task $task): Task
    {
        $task->update($request->toArray());
        
        return $task;
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }

    public function assigned(User $user)
    {
        return $user->tasks();
    }
    
    public function assign(Task $task, $assignedTo)
    {
        return $task->update(['assigned_to' => $assignedTo]);
    }
}