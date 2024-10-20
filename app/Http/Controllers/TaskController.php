<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        Task::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'completed' => false,
        ]);

        return redirect()->route('tasks.index');
    }

    
    public function edit(Task $task)
    {
        // Ensure the user is the owner of the task
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    
    public function update(Request $request, Task $task)
    {
        // Ensure the user is the owner of the task
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // Validate the task data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the task
        $task->update([
            'name' => $request->name,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        // Ensure the user is the owner of the task
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete the task
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function toggleCompletion(Task $task)
    {
        // Ensure the user is the owner of the task
        if ($task->user_id !== Auth::id()) {
            abort(403); // Forbid access if the user does not own the task
        }

        // Toggle the completion status
        $task->completed = !$task->completed;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task status updated successfully!');
    }
}
