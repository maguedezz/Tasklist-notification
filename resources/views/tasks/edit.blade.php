@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Task</h1>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Task Title -->
            <div class="form-group">
                <label for="title">Task Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
            </div>

            <!-- Due Date -->
            <div class="form-group mt-3">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date ? $task->due_date->toDateString() : '' }}">
            </div>

            <!-- Priority -->
            <div class="form-group mt-3">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-control" required>
                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <button type="submit" class="btn btn-warning mt-3">Update Task</button>
        </form>
    </div>
@endsection
