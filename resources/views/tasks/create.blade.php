@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Create New Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <!-- Task Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Task Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <!-- Due Date -->
        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control">
        </div>

        <!-- Priority -->
        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <select name="priority" id="priority" class="form-control" required>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Task</button>
        
    </form>
</div>
@endsection
