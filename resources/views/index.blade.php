@extends('layouts.app')

@section('title', 'Task List')

@section('content')
    <div>

        {{-- cicla sulla collection se questa non è vuota --}}
        @forelse ($tasks as $task)
            <div>
                <a href=" {{ route('tasks.show', ['id' => $task->id]) }}">
                    <h2>{{ $task->title }}</h2>
                    <p>{{ $task->description }}</p>
                </a>
                @if ($task->completed)
                    <p>&check;</p>
                @else
                    <p>&cross;</p>
                @endif
            </div>

        @empty
            <div>
                <p>There are no tasks</p>
            </div>
        @endforelse


    </div>
@endsection
