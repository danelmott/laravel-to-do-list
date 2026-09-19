<?php

namespace App\Http\Controllers;

use App\Exceptions\ResourceNotFound;
use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::cursorPaginate(15);


        return response()->json([
            'message' => 'Tasks successfully retrieved',
            'taks' => $tasks
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|required|min:3|max:50',
            'description' => 'string|required|min:3|max:300'
        ]);

        $task = $request->user()->tasks()->create($data);

        return response()->json([
            'message' => 'task successfully created',
            'task' => $task
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task = Task::find($task)
        ?? throw new ResourceNotFound('Task');

        return response()->json([
            'message' => 'Task successfully retrieved',
            'task' => $task
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'string|nullable|min:3|max:50',
            'description' => 'string|nullable|min:3|max:300'
        ]);

        $task = Task::find($task)
        ?? throw new ResourceNotFound('Task');

        $task->update($data);

        return response()->json([
            'message' => 'task successfully updated',
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task = Task::find($task)
        ?? throw new ResourceNotFound('Task');

        $task->delete();

        return response()->json([
            'message' => 'task successfully deleted',
            'task' => $task
        ]);
    }

    public function complete(Task $task)
    {
        $task = Task::find($task)
        ?? throw new ResourceNotFound('Task');

        $toggleComplete = ! $task->complete;
        $message = $toggleComplete ? 'Task successfully marked as completed' : 'Task successfully marked as pending';

        $task->update(['completed' => $toggleComplete]);

        return response()->json([
            'message' => $message,
        ], 200);
    }
}
