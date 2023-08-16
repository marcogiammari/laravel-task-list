{{-- esempio di subview valido sia per il create che per l'edit view --}}

@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add New Task')

{{-- @section('styles')
    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
        }
    </style>
@endsection --}}

@section('content')

    <form action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}" method="post">

        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-4">
            <label for="title">
                Title
            </label>

            {{-- la direttiva blade @class assegna la classe border-etc all'input se c'è un errore nel titolo, grazie al metodo built-in di $errors has('title'). In alternativa è possibile usare la direttiva @error all'interno dell'attributo class dell'input --}}
            <input type="text" name="title" id="title" @class(['border-red-500' => $errors->has('title')])
                value="{{ $task->title ?? old('title') }}">
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description">
                Description
            </label>
            <textarea @class(['border-red-500' => $errors->has('description')]) name="description" id="description" rows="5">{{ $task->description ?? old('description') }}
            </textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_description">
                Description
            </label>
            <textarea @class(['border-red-500' => $errors->has('long_description')]) name="long_description" id="long_description" rows="10">{{ $task->long_description ?? old('long_description') }}
        </textarea>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center gap-2">
            <button class="btn" type="submit">
                @isset($task)
                    Edit Task
                @else
                    Add Task
                @endisset
            </button>
            <a href="{{ route('tasks.index') }}" class="link">Cancel</a>
        </div>
    </form>
@endsection
