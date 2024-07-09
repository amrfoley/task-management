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
}