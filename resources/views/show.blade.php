@extends('layouts.app')

@section('title', $task->title)

@section('content')
    @if ($task->desc)
        <p>{{ $task->desc }}</p>
    @else
        No Description
    @endif
@endsection
