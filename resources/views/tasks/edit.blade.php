@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Task</h1>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Task Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
            </div>
            <button type="submit" class="btn btn-warning mt-3">Update Task</button>
        </form>
    </div>
@endsection
