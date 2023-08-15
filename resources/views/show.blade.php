@extends('layouts.app')

@section('title', $task->title)

@section('content')
    @if ($task->long_description)
        <p>{{ $task->long_description }}</p>
    @else
        No Description
    @endif
    <div>
        <a href="{{ route('tasks.edit', ['id' => $task->id]) }}">Edit Task</a>
    </div>
@endsection
