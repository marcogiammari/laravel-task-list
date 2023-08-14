@extends('layouts.app')

@section('title', $task->title)

@section('content')
    @if ($task->long_description)
        <p>{{ $task->long_description }}</p>
    @else
        No Description
    @endif
@endsection
