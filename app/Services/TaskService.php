<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskService
{   
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
}