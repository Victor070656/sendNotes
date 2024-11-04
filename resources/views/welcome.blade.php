<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center  selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid items-center justify-end gap-2 py-10 grid-cols-">

                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
                </header>



            </div>
            <div class="p-6 mx-auto text-center max-w-7xl lg:p-8">
                <x-application-logo class="w-48 h-48 fill-current text-primary-600" />
                <x-button primary xl href="{{ route('register') }}" wire:navigate>Get
                    Started</x-button>
            </div>
        </div>
    </div>
</body>

</html>
