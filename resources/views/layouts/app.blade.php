<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Task List</title>
    @yield('styles')
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- alpine.js cdn --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-2 py-1 text-center font-medium text-slate-700 shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50
        }
        
        .link {
            @apply font-medium text-gray-700 underline decoration-pink-500
        }
        
        label {
            @apply block uppercase text-slate-700 mb-2
        }

        input, textarea {
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
        }

        .error {
            @apply text-red-500 text-sm
        }
    </style>
    {{-- blade-formatter-enable --}}
</head>

<body class="container mx-auto mt-10 max-w-lg">
    <h1 class="mb-4 text-2xl">
        @yield('title')
    </h1>

    {{-- esempio d'uso di alpine:
    il div con x-show="flash" è visibile o no in base alla variable x-data="{flash: true}".
    La croce in SVG ha la direttiva @click che imposta flash su false e chiude il flash message --}}
    <div x-data="{ flash: true }">
        {{-- mostra il messaggio flash se esiste --}}
        {{-- @if (session()->has('success')) --}}
        {{-- <div>
                {{ session('success') }}
            </div> --}}

        {{-- l'attributo role viene usato per accessibilità --}}
        @if (session()->has('success'))
            <div x-show="flash"
                class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <div>{{ session('success') }}</div>
                <span class="absolute right-0 top-0 px-4 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6 cursor-pointer" @click="flash = false">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>
        @endif
        {{-- @endif --}}
        @yield('content')
        <div class="justify-content-end absolute bottom-10 right-10 flex">
            <p>Copyright &copy;</p>
            <span x-text="new Date().getFullYear()"></span>
        </div>
    </div>
</body>

</html>
