<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">

        <title>{{ isset($title) ? $title.' · ' : '' }}{{ config('app.name', 'ERP Internal') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('images/mnc-logo.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=lexend:400,500,600,700&display=swap" rel="stylesheet" />

        <script>
            (function () {
                try {
                    var saved = localStorage.getItem('erp_theme');
                    var isDark = saved ? saved === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
                    document.documentElement.classList.toggle('dark', isDark);
                } catch (e) {}
            })();
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        class="font-sans text-white antialiased bg-primary dark:bg-slate-950"
        x-data="{
            dark: document.documentElement.classList.contains('dark'),
            flying: false,
            toggleTheme() {
                this.flying = true;
                this.dark = !this.dark;
                document.documentElement.classList.toggle('dark', this.dark);
                try { localStorage.setItem('erp_theme', this.dark ? 'dark' : 'light'); } catch (e) {}
                setTimeout(() => { this.flying = false; }, 560);
            }
        }"
    >
        <div class="relative isolate flex min-h-dvh flex-col justify-between bg-gradient-to-br from-[#08173D] via-primary to-[#153B8A] dark:from-slate-950 dark:via-[#081430] dark:to-[#0F2A6B]">
            {{-- Subtle MNC University eagle watermark in the background canvas to give depth behind the right glass card --}}
            <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
                <img
                    src="{{ asset('images/mnc-logo.png') }}"
                    alt=""
                    width="557"
                    height="448"
                    class="absolute -right-16 top-1/2 w-[460px] max-w-none -translate-y-1/2 select-none opacity-[0.08] brightness-0 invert md:w-[620px] lg:right-8 lg:w-[740px]"
                >
            </div>

            <header class="flex items-center justify-end px-4 pt-3 md:px-8 md:pt-4 lg:px-12">
                <x-theme-toggle />
            </header>

            <main class="mx-auto flex w-full max-w-[1280px] flex-1 items-center px-5 py-4 md:px-10 lg:px-16">
                {{ $slot }}
            </main>

            <footer class="px-4 py-3 text-center text-xs text-slate-200 md:text-[13px]">
                {{ date('Y') }} &copy; Hak Cipta MNC University.
            </footer>
        </div>
    </body>
</html>
