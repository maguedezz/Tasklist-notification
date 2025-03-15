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

            <!-- Add Priority Filter -->
        <div class="mb-3">
            <label for="priority" class="form-label">Filter by Priority</label>
            <select name="priority" class="form-control" id="priority">
                <option value="">All Priorities</option>
                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
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
                    <div>
                        <strong>{{ $task->title }}</strong>
                        
                        <!-- Display Due Date only if it's not null -->
                        @if($task->due_date)
                            <br><small>Due Date: {{ $task->due_date->format('d M Y') }}</small>
                        @else
                            <br><small>No Due Date</small>
                        @endif
                    </div>

                    <!-- Display Task Priority -->
                    <span>
                        @if($task->priority == 'low')
                            <span class="badge bg-success">Low Priority</span>
                        @elseif($task->priority == 'medium')
                            <span class="badge bg-warning">Medium Priority</span>
                        @elseif($task->priority == 'high')
                            <span class="badge bg-danger">High Priority</span>
                        @endif
                    </span>

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
