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

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection
