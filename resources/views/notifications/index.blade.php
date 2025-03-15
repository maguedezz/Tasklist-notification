@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Notifications</h1>
        <ul class="list-group">
            @forelse($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        {{ $notification->data['message'] ?? 'No message' }}
                    </span>
                    @if(isset($notification->data['task_id']))
                        <a href="{{ route('tasks.show', $notification->data['task_id']) }}" class="btn btn-primary btn-sm">View Task</a>
                    @endif
                </li>
            @empty
                <li class="list-group-item text-center">No notifications found.</li>
            @endforelse
        </ul>
    </div>
@endsection
