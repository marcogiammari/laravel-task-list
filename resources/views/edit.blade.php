@extends('layouts.app')

@section('title', 'Edit Task')

@section('styles')
    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('content')

    {{-- laravel restituisce un oggetto $errors che contiene tutti gli errori generati dalla validazione --}}
    {{-- {{ $errors }} --}}
    {{-- per accedere al messaggio invece si usa la variabile $message  --}}

    <form action="{{ route('tasks.update', ['id' => $task->id]) }}" method="post">

        {{-- il csrf attacca un cookie al browser per verifiche di sicurezza. Può essere un file, ma per progetti più importanti si usa Redis (un db), memcached o altri metodi che trovi in config.session --}}
        @csrf

        {{-- aggiunge ai form data una proprietà _method: 'PUT'  --}}
        @method('PUT')
        <div>
            <label for="title">
                Title
            </label>
            <input type="text" name="title" id="title" value="{{ $task->title }}">
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="description">
                Description
            </label>
            <textarea name="description" id="description" rows="5">{{ $task->description }}
            </textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="long_description">
                Description
            </label>
            <textarea name="long_description" id="long_description" rows="10">{{ $task->long_description }}
        </textarea>
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit">Edit Task</button>
        </div>
    </form>
@endsection
