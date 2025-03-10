@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Tasks</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('tasks.index') }}">
            <div class="mb-3">
                <label for="status" class="form-label">Filter by Status</label>
                <select name="status" class="form-control" id="status">
                    <option value="">All Tasks</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <!-- Add Task Button -->
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mt-4">Add Task</a>

        <!-- Task List -->
        <ul class="list-group mt-4">
            @foreach($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $task->title }}
                    <span>
                        @if(!$task->is_completed)
                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
                        </form>
                    @else
                        <span class="badge bg-success">Completed</span>
                    @endif
                        <!-- Edit Task Button -->
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <!-- Mark as Completed Button -->
                      

                        <!-- Delete Task Button -->
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
