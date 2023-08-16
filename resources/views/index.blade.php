@extends('layouts.app')

@section('title', 'Task List')

@section('content')
    <nav class="mb-4">
        <a class="font-medium text-gray-700 underline decoration-pink-500" href="{{ route('tasks.create') }}">
            New Task
        </a>
    </nav>

    {{-- cicla sulla collection se questa non è vuota --}}
    @forelse ($tasks as $task)
        <a href=" {{ route('tasks.show', ['task' => $task->id]) }}" @class(['line-through' => $task->completed])>
            {{ $task->title }}
        </a>
        @if ($task->completed)
            <p>&check;</p>
        @else
            <p>&cross;</p>
        @endif

    @empty
        <div>
            <p>There are no tasks</p>
        </div>
    @endforelse

    @if ($tasks->count())
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection
