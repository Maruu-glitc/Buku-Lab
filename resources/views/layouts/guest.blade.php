<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script>
        (function () {
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-white dark:bg-slate-950 dark:text-slate-100">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-slate-900">
        <div class="absolute top-4 right-4">
            <button id="theme-toggle" type="button" aria-label="Toggle dark mode"
                class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-white/20 bg-white/10 text-gray-900 shadow-sm transition hover:bg-white/20 dark:border-slate-500 dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700">
                <svg id="theme-toggle-dark-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m8.66-11.66l-.7.7M5.34 17.66l-.7.7m16 0h-1M4 12H3m15.36 6.36l-.7-.7M6.34 6.34l-.7-.7M12 5a7 7 0 100 14 7 7 0 000-14z">
                    </path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3C10.895 3 10 3.895 10 5s.895 2 2 2 2-.895 2-2-.895-2-2-2zm0 14c-1.105 0-2 .895-2 2s.895 2 2 2 2-.895 2-2-.895-2-2-2zm9-7c0 1.105-.895 2-2 2s-2-.895-2-2 .895-2 2-2 2 .895 2 2zm-16 0c0 1.105-.895 2-2 2S1 11.105 1 10s.895-2 2-2 2 .895 2 2zm13.071 6.071a1 1 0 01-.707 1.707 1 1 0 01-.707-.293l-1.414-1.414a1 1 0 011.414-1.414l1.414 1.414zm-10.243 0l1.414-1.414a1 1 0 011.414 1.414l-1.414 1.414a1 1 0 01-1.414-1.414zM17.657 6.343a1 1 0 01-.707 1.707 1 1 0 01-.707-.293l-1.414-1.414a1 1 0 011.414-1.414l1.414 1.414zm-10.243 0l1.414 1.414a1 1 0 01-1.414 1.414L5.293 7.657A1 1 0 016.343 6.343z">
                    </path>
                </svg>
            </button>
        </div>

        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500 dark:text-slate-300" />
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg dark:bg-slate-800">
            {{ $slot }}
        </div>
    </div>
</body>

</html>