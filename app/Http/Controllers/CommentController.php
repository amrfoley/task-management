<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use App\Services\CommentService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreUpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Comment::class);

        return CommentResource::collection(Comment::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCommentRequest $request, string $task_id)
    {
        Gate::authorize('create', Comment::class);
        $task = (new TaskService())->getById($task_id);
        (new CommentService())->publish($request, $task);

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCommentRequest $request, string $task_id, Comment $comment)
    {
        if ($request->user()->cannot('update', $comment)) {
            abort(403);
        }

        (new CommentService())->update($request, $comment);

        return new TaskResource($comment->task->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $task_id, Comment $comment)
    {
        if (auth('sanctum')->user()->cannot('delete', $comment)) {
            abort(403);
        }

        $deleted = (new CommentService())->delete($comment);

        return response($deleted? 'Comment deleted!' : 'Failed to delete!');
    }
}
