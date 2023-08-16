@extends('layouts.app')

@section('title', $task->title)

@section('content')
    @if ($task->long_description)
        <p>{{ $task->long_description }}</p>
    @else
        No Description
    @endif
    <div>
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">Edit Task</a>
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
