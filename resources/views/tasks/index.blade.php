@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">To-Do List</h1>

    <!-- Task Creation Form -->
    <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="New Task" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Add Task</button>
    </form>

    <!-- List of Tasks -->
    <h2>My Tasks</h2>
    <ul class="list-group">
        @if ($tasks->isEmpty())
            <li class="list-group-item">No tasks available. Add a new task!</li>
        @else
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <form action="{{ route('tasks.toggleCompletion', $task) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH') <!-- Use PATCH here -->
                        <button type="submit" class="btn {{ $task->completed ? 'btn-success' : 'btn-warning' }}">
                            {{ $task->completed ? 'Completed' : 'Incomplete' }}
                        </button>
                    </form>

                    <span class="flex-grow-1 mx-3">{{ $task->name }}</span>

                    <div>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary">Edit</a>
                        
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>
@endsection

