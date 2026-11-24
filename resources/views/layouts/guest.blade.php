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
        <link href="https://fonts.bunny.net/css?family=lexend:400,500,600&display=swap" rel="stylesheet" />

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
        class="font-sans text-ink antialiased bg-subtle dark:bg-slate-950 dark:text-slate-100"
        x-data="{
            dark: document.documentElement.classList.contains('dark'),
            toggleTheme() {
                this.dark = !this.dark;
                document.documentElement.classList.toggle('dark', this.dark);
                try { localStorage.setItem('erp_theme', this.dark ? 'dark' : 'light'); } catch (e) {}
            }
        }"
    >
        <div class="relative isolate flex min-h-dvh flex-col">
            <div aria-hidden="true" class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-[48vh] min-h-[240px] overflow-hidden bg-primary">
                <img
                    src="{{ asset('images/mnc-logo.png') }}"
                    alt=""
                    width="557"
                    height="448"
                    class="absolute left-1/2 top-4 w-[320px] max-w-none -translate-x-1/2 select-none opacity-[0.09] brightness-0 invert md:w-[440px] lg:w-[540px]"
                >
            </div>

            <header class="absolute right-3 top-3 z-10 md:right-6 md:top-4 lg:right-8">
                <button
                    type="button"
                    x-on:click="toggleTheme()"
                    x-bind:aria-pressed="dark.toString()"
                    x-bind:aria-label="dark ? 'Aktifkan mode terang' : 'Aktifkan mode gelap'"
                    aria-label="Ganti tema tampilan"
                    class="inline-flex min-h-[44px] items-center gap-2 rounded-md border border-white/60 bg-primary-hover px-3.5 py-2 text-[13px] font-medium text-white transition-colors hover:bg-[#08173D] focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-primary active:bg-slate-950"
                >
                    <svg x-show="!dark" aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79Z" />
                    </svg>
                    <svg x-show="dark" x-cloak aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="12" r="4" />
                        <path stroke-linecap="round" d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                    </svg>
                    <span x-text="dark ? 'Mode Terang' : 'Mode Gelap'">Mode Gelap</span>
                </button>
            </header>

            <main class="flex flex-1 items-center justify-center px-3 py-4 md:px-6">
                <div class="auth-glass w-full max-w-[390px] rounded-lg px-5 py-6 md:max-w-[420px] md:px-8 md:py-7">
                    {{ $slot }}
                </div>
            </main>

            <footer class="border-t border-line bg-white py-3 text-center text-[13px] text-ink-muted md:text-sm dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300">
                {{ date('Y') }} &copy; Hak Cipta MNC University.
            </footer>
        </div>
    </body>
</html>
