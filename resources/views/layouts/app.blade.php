<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Task List</title>
    @yield('styles')
</head>

<body>
    <a href="{{ route('tasks.index') }}">
        <h1>
            Home
        </h1>
    </a>

    <h1>
        @yield('title')
    </h1>
    <div>
        {{-- mostra il messaggio flash se esiste --}}
        @if (session()->has('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
