@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <input type="text" name="name" class="form-control" value="{{ $task->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Edit Task</button>
    </form>
</div>
@endsection
