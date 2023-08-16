@extends('layouts.app')

@section('title', $task->title)

@section('content')
    @if ($task->long_description)
        <p>{{ $task->long_description }}</p>
    @else
        No Description
    @endif

    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>

    <p>
        @if ($task->completed)
            Completed
            &check;
        @else
            Not completed
            &cross;
        @endif
    </p>

    <div>
        <a href="{{ route('tasks.edit', $task) }}">Edit Task</a>
    </div>

    {{-- toggle-complete  --}}
    <div>
        <form action="{{ route('tasks.toggle-complete', $task) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit">Mark as {{ $task->completed ? 'not completed' : 'completed' }}</button>
        </form>
    </div>

    <div>

        {{-- delete form  --}}
        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Task</button>
        </form>
    </div>
@endsection
