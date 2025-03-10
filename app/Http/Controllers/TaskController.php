<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the status filter from the request

        $status = $request->get('status');

        if ($status === 'completed') {
            $tasks = Task::where('is_completed', true)->get();
        } elseif ($status === 'pending') {
            $tasks = Task::where('is_completed', false)->get();
        } else {
            $tasks = Task::all();
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200'
        ]);

        Task::create([
            'title' => $request->title,
            'user_id' => auth()->id(),
            'is_completed' => false

        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:200'
        ]);

        $task->update([
            'title' => $request->title,
            'user_id' => auth()->id(),
            'is_completed' => false

        ]);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'You are not authorized to take this action');
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('sucess', 'Your task is removed successfully');
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function markCompleted(Task $task)
    {
        if (auth()->id() !== $task->user_id) {
            return abort(403, 'You are not authorized to perform this action');
        } 

        $task->update(['is_completed' => true]);

        return redirect()->route('tasks.index')->with('success', 'Marked as completed');
    }
}
