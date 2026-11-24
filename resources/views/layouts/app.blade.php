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
            sidebarOpen: true,
            mobileDrawerOpen: false,
            userMenuOpen: false,
            activeMenu: 'dashboard',
            activeFeatureLabel: 'Dashboard Utama',
            scheduleState: 'empty',
            openGroups: { perkuliahan: true, layanan: false, beasiswa: false, skripsi: false },
            dark: document.documentElement.classList.contains('dark'),
            flying: false,
            toggleTheme() {
                this.flying = true;
                this.dark = !this.dark;
                document.documentElement.classList.toggle('dark', this.dark);
                try { localStorage.setItem('erp_theme', this.dark ? 'dark' : 'light'); } catch (e) {}
                setTimeout(() => { this.flying = false; }, 560);
            },
            toggleSidebar() {
                if (window.innerWidth < 1024) {
                    this.mobileDrawerOpen = !this.mobileDrawerOpen;
                } else {
                    this.sidebarOpen = !this.sidebarOpen;
                }
            },
            selectFeature(key, label) {
                this.activeMenu = key;
                this.activeFeatureLabel = label;
                if (window.innerWidth < 1024) {
                    this.mobileDrawerOpen = false;
                }
            },
            toggleGroup(group) {
                if (!this.sidebarOpen && window.innerWidth >= 1024) {
                    this.sidebarOpen = true;
                }
                this.openGroups[group] = !this.openGroups[group];
            }
        }"
        x-on:keydown.escape.window="mobileDrawerOpen = false; userMenuOpen = false"
        x-bind:class="{ 'overflow-hidden lg:overflow-auto': mobileDrawerOpen }"
    >
        <div class="flex min-h-dvh">
            @include('layouts.navigation')

            <div class="flex min-w-0 flex-1 flex-col">
                {{-- Floating Navbar per spesifikasi-desain-ui.md section 4 --}}
                <header class="sticky top-3 z-30 mx-3 mt-3 md:mx-6 lg:top-4 lg:mx-6 lg:mt-4">
                    <div class="flex h-14 items-center justify-between rounded-lg border border-line bg-white px-4 shadow-md lg:h-[70px] lg:px-7 dark:border-slate-800 dark:bg-slate-900">
                        <div class="flex items-center gap-3">
                            <button
                                type="button"
                                x-on:click="toggleSidebar()"
                                x-bind:aria-expanded="(window.innerWidth < 1024 ? mobileDrawerOpen : sidebarOpen).toString()"
                                aria-controls="erp-sidebar"
                                aria-label="Buka atau tutup menu sidebar"
                                class="btn-interactive inline-flex h-11 w-11 items-center justify-center rounded-md text-primary hover:bg-primary-soft focus:outline-none focus-visible:ring-2 focus-visible:ring-primary lg:hidden dark:text-sky-400 dark:hover:bg-slate-800"
                            >
                                <svg aria-hidden="true" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>

                            <a href="{{ route('dashboard') }}" class="btn-interactive flex items-center rounded-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">
                                <span class="text-base font-medium text-primary lg:hidden dark:text-white">
                                    ERP MNCU
                                </span>
                                <span class="hidden text-[22px] font-medium text-primary lg:inline dark:text-white">
                                    ERP Internal MNC University
                                </span>
                            </a>
                        </div>

                        <div class="flex items-center gap-3 md:gap-4">
                            {{-- User dropdown di sebelah kiri tombol toggle tema --}}
                            <div class="relative" x-on:click.outside="userMenuOpen = false">
                                <button
                                    type="button"
                                    x-on:click="userMenuOpen = !userMenuOpen"
                                    aria-haspopup="menu"
                                    x-bind:aria-expanded="userMenuOpen.toString()"
                                    aria-label="Menu akun {{ Auth::user()->name }}"
                                    class="btn-interactive flex min-h-[44px] items-center gap-3 rounded-md px-2 py-1 hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary dark:hover:bg-slate-800"
                                >
                                    <div class="hidden text-right lg:block">
                                        <p class="text-base font-medium leading-tight text-primary dark:text-white">
                                            {{ Auth::user()->name }}
                                        </p>
                                        <p class="text-sm leading-tight text-ink-muted dark:text-slate-300">
                                            ID: {{ strtoupper(Auth::user()->username ?? 'USER') }}
                                        </p>
                                    </div>

                                    <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-slate-400 bg-primary-soft text-sm font-semibold text-primary lg:h-12 lg:w-12 dark:border-slate-500 dark:bg-slate-800 dark:text-sky-300">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                    </span>

                                    <svg
                                        aria-hidden="true"
                                        class="hidden h-4 w-4 text-ink-muted transition-transform duration-200 lg:block dark:text-slate-300"
                                        x-bind:class="{ 'rotate-180': userMenuOpen }"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div
                                    x-show="userMenuOpen"
                                    x-cloak
                                    x-transition.opacity.duration.150ms
                                    role="menu"
                                    class="absolute right-0 mt-2 w-60 overflow-hidden rounded-md border border-line bg-white shadow-md dark:border-slate-700 dark:bg-slate-900"
                                >
                                    <div class="border-b border-line px-4 py-3 dark:border-slate-800">
                                        <p class="text-sm font-medium text-primary dark:text-white">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-ink-muted dark:text-slate-300">{{ Auth::user()->email }} · ID {{ strtoupper(Auth::user()->username ?? 'USER') }}</p>
                                    </div>

                                    <div class="py-1">
                                        <a
                                            href="{{ route('profile.edit') }}"
                                            role="menuitem"
                                            class="btn-interactive flex h-11 items-center gap-3 px-4 text-sm text-ink hover:bg-[#F3F4F6] dark:text-slate-100 dark:hover:bg-slate-800"
                                        >
                                            <svg aria-hidden="true" class="h-4 w-4 text-ink-secondary dark:text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <circle cx="12" cy="8" r="4" />
                                                <path stroke-linecap="round" d="M4 20c1.8-3.5 5-5 8-5s6.2 1.5 8 5" />
                                            </svg>
                                            <span>Profil Saya</span>
                                        </a>

                                        <a
                                            href="{{ route('profile.edit') }}#update-password"
                                            role="menuitem"
                                            class="btn-interactive flex h-11 items-center gap-3 px-4 text-sm text-ink hover:bg-[#F3F4F6] dark:text-slate-100 dark:hover:bg-slate-800"
                                        >
                                            <svg aria-hidden="true" class="h-4 w-4 text-ink-secondary dark:text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                <rect x="4" y="11" width="16" height="9" rx="2" />
                                                <path stroke-linecap="round" d="M8 11V7a4 4 0 1 1 8 0v4" />
                                            </svg>
                                            <span>Ubah Password</span>
                                        </a>
                                    </div>

                                    <div class="border-t border-line py-1 dark:border-slate-800">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button
                                                type="submit"
                                                role="menuitem"
                                                class="btn-interactive flex h-11 w-full items-center gap-3 px-4 text-left text-sm font-medium text-rose-700 hover:bg-rose-50 dark:text-rose-300 dark:hover:bg-rose-950/50"
                                            >
                                                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3-3l3-3m0 0l-3-3m3 3H9" />
                                                </svg>
                                                <span>Keluar</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol toggle Dark/Light Mode di posisi paling kanan navbar --}}
                            <x-theme-toggle />
                        </div>
                    </div>
                </header>

                @isset($header)
                    <div class="mx-auto w-full max-w-[1570px] px-4 pt-6 md:px-6 lg:px-[50px] lg:pt-8">
                        {{ $header }}
                    </div>
                @endisset

                <main class="mx-auto w-full max-w-[1570px] flex-1 px-3 py-6 md:px-6 lg:px-[50px] lg:py-8">
                    {{ $slot }}
                </main>

                <footer class="mt-8 border-t border-line bg-white py-5 text-center text-[13px] text-ink-muted md:text-sm lg:text-base dark:border-slate-800 dark:bg-slate-900 dark:text-slate-300">
                    {{ date('Y') }} &copy; Hak Cipta MNC University.
                </footer>
            </div>
        </div>
    </body>
</html>
