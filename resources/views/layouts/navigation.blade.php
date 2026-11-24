{{-- Mobile backdrop overlay per spesifikasi-desain-ui.md section 5.2 --}}
<div
    x-show="mobileDrawerOpen"
    x-cloak
    x-transition.opacity.duration.200ms
    x-on:click="mobileDrawerOpen = false"
    aria-hidden="true"
    class="fixed inset-0 z-40 bg-slate-900/45 lg:hidden"
></div>

{{--
    Sidebar per user instruction & spesifikasi-desain-ui.md section 5:
    1. MNC University Logo at the very top
    2. Burger button directly below the logo to expand/collapse the sidebar
    3. Feature menu buttons with hover & click transitions below
--}}
<aside
    id="erp-sidebar"
    aria-label="Navigasi Modul ERP"
    x-bind:class="{
        'translate-x-0': mobileDrawerOpen,
        '-translate-x-full lg:translate-x-0': !mobileDrawerOpen,
        'lg:w-[320px] xl:w-[360px]': sidebarOpen,
        'lg:w-[88px]': !sidebarOpen
    }"
    class="fixed inset-y-0 left-0 z-50 flex w-[82vw] max-w-[320px] shrink-0 flex-col border-r border-line bg-white shadow-[4px_0_24px_rgba(0,0,0,0.12)] transition-all duration-250 ease-out motion-reduce:transition-none lg:sticky lg:top-0 lg:z-30 lg:h-dvh lg:max-w-none dark:border-slate-800 dark:bg-slate-900"
>
    {{-- Top Section: Logo at the very top, followed by the Burger Button directly underneath --}}
    <div class="flex flex-col items-center border-b border-[#2563EB] px-4 pb-4 pt-5">
        <div class="relative flex w-full items-center justify-center">
            <a
                href="{{ route('dashboard') }}"
                x-on:click="selectFeature('dashboard', 'Dashboard Utama')"
                class="btn-interactive flex flex-col items-center rounded-md p-1 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary"
            >
                <img
                    x-show="sidebarOpen"
                    src="{{ asset('images/mnc-logo-text.png') }}"
                    alt="MNC University"
                    width="529"
                    height="472"
                    class="h-20 w-auto lg:h-[96px] dark:brightness-0 dark:invert"
                >
                <img
                    x-show="!sidebarOpen"
                    x-cloak
                    src="{{ asset('images/mnc-logo.png') }}"
                    alt="MNC University"
                    width="557"
                    height="448"
                    class="h-11 w-auto dark:brightness-0 dark:invert"
                >
            </a>

            <button
                type="button"
                x-on:click="mobileDrawerOpen = false"
                aria-label="Tutup menu"
                class="btn-interactive absolute right-0 top-0 inline-flex h-11 w-11 items-center justify-center rounded-md text-ink-muted hover:bg-slate-100 hover:text-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-primary lg:hidden dark:text-slate-300 dark:hover:bg-slate-800"
            >
                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <p
            x-show="sidebarOpen"
            class="mt-2 text-center text-[17px] font-semibold text-ink lg:text-lg dark:text-white"
        >
            Menu Portal ERP
        </p>

        {{-- Burger button directly below the logo --}}
        <button
            id="sidebar-burger-btn"
            type="button"
            x-on:click="toggleSidebar()"
            x-bind:aria-expanded="sidebarOpen.toString()"
            aria-controls="erp-sidebar"
            x-bind:aria-label="sidebarOpen ? 'Ciutkan sidebar' : 'Bentangkan sidebar'"
            aria-label="Toggle sidebar"
            class="btn-interactive mt-3 inline-flex min-h-[44px] w-full items-center justify-center gap-2.5 rounded-md border border-slate-400 bg-subtle px-3.5 py-2 text-sm font-medium text-primary hover:border-primary hover:bg-primary-soft focus:outline-none focus-visible:ring-2 focus-visible:ring-primary dark:border-slate-600 dark:bg-slate-800 dark:text-sky-300 dark:hover:border-sky-400 dark:hover:bg-slate-700"
        >
            <svg aria-hidden="true" class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span x-show="sidebarOpen" class="truncate">Ciutkan Menu</span>
        </button>
    </div>

    {{-- Feature navigation buttons per spesifikasi-desain-ui.md section 5.4 & 5.5 --}}
    <nav aria-label="Daftar fitur ERP" class="flex-1 space-y-1 overflow-y-auto py-4">
        {{-- 1. Dashboard --}}
        <button
            type="button"
            x-on:click="selectFeature('dashboard', 'Dashboard Utama')"
            x-bind:aria-current="activeMenu === 'dashboard' ? 'page' : false"
            x-bind:class="activeMenu === 'dashboard'
                ? 'border-l-[3px] border-primary bg-[#EEF2FF] font-medium text-primary dark:border-sky-400 dark:bg-slate-800 dark:text-sky-300'
                : 'text-ink hover:bg-[#F3F4F6] dark:text-slate-100 dark:hover:bg-slate-800/70'"
            class="btn-interactive flex min-h-[46px] w-full items-center gap-4 px-5 text-left text-[15px] lg:min-h-[52px] lg:px-7 lg:text-[17px]"
        >
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-sm bg-indigo-50 text-primary dark:bg-slate-800 dark:text-sky-300">
                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="7" height="9" rx="1.5" />
                    <rect x="14" y="3" width="7" height="5" rx="1.5" />
                    <rect x="14" y="12" width="7" height="9" rx="1.5" />
                    <rect x="3" y="16" width="7" height="5" rx="1.5" />
                </svg>
            </span>
            <span x-show="sidebarOpen" class="flex-1 truncate">Dashboard</span>
        </button>

        {{-- 2. Jadwal Perkuliahan (// TODO: connect to academic schedule module) --}}
        <button
            type="button"
            x-on:click="selectFeature('jadwal', 'Jadwal Perkuliahan')"
            x-bind:aria-current="activeMenu === 'jadwal' ? 'page' : false"
            x-bind:class="activeMenu === 'jadwal'
                ? 'border-l-[3px] border-primary bg-[#EEF2FF] font-medium text-primary dark:border-sky-400 dark:bg-slate-800 dark:text-sky-300'
                : 'text-ink hover:bg-[#F3F4F6] dark:text-slate-100 dark:hover:bg-slate-800/70'"
            class="btn-interactive flex min-h-[46px] w-full items-center gap-4 px-5 text-left text-[15px] lg:min-h-[52px] lg:px-7 lg:text-[17px]"
        >
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-sm bg-sky-50 text-sky-800 dark:bg-slate-800 dark:text-sky-300">
                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="5" width="18" height="16" rx="2" />
                    <path stroke-linecap="round" d="M16 3v4M8 3v4M3 10h18" />
                </svg>
            </span>
            <span x-show="sidebarOpen" class="flex-1 truncate">Jadwal Perkuliahan</span>
        </button>

        {{-- 3. Perkuliahan (Collapsible Group) --}}
        <div>
            <button
                type="button"
                x-on:click="toggleGroup('perkuliahan')"
                x-bind:aria-expanded="openGroups.perkuliahan.toString()"
                class="btn-interactive flex min-h-[46px] w-full items-center gap-4 px-5 text-left text-[15px] text-ink hover:bg-[#F3F4F6] lg:min-h-[52px] lg:px-7 lg:text-[17px] dark:text-slate-100 dark:hover:bg-slate-800/70"
            >
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-sm bg-purple-50 text-purple-800 dark:bg-slate-800 dark:text-purple-300">
                    <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </span>
                <span x-show="sidebarOpen" class="flex-1 truncate">Perkuliahan</span>
                <svg
                    x-show="sidebarOpen"
                    aria-hidden="true"
                    class="h-[18px] w-[18px] shrink-0 text-ink-muted transition-transform duration-200 dark:text-slate-300"
                    x-bind:class="{ 'rotate-180': openGroups.perkuliahan }"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </button>

            <div
                x-show="sidebarOpen && openGroups.perkuliahan"
                x-cloak
                class="space-y-1 py-1"
            >
                @php
                    // TODO: Replace dummy submenu views with dedicated controllers when academic modules ship.
                    $perkuliahanItems = [
                        ['key' => 'input-rps', 'label' => 'Input RPS'],
                        ['key' => 'kelola-materi', 'label' => 'Kelola Materi & Presensi'],
                        ['key' => 'input-nilai', 'label' => 'Input Nilai'],
                        ['key' => 'forum-perkuliahan', 'label' => 'Forum Perkuliahan'],
                    ];
                @endphp
                @foreach ($perkuliahanItems as $item)
                    <button
                        type="button"
                        x-on:click="selectFeature('{{ $item['key'] }}', '{{ $item['label'] }}')"
                        x-bind:aria-current="activeMenu === '{{ $item['key'] }}' ? 'page' : false"
                        x-bind:class="activeMenu === '{{ $item['key'] }}'
                            ? 'bg-[#EEF2FF] font-medium text-primary dark:bg-slate-800 dark:text-sky-300'
                            : 'text-[#4B5563] hover:bg-[#F3F4F6] hover:text-primary dark:text-slate-300 dark:hover:bg-slate-800/60 dark:hover:text-white'"
                        class="btn-interactive flex min-h-[44px] w-full items-center gap-2.5 pl-[62px] pr-5 text-left text-sm lg:pl-[74px] lg:text-base"
                    >
                        <span aria-hidden="true" class="h-1.5 w-1.5 shrink-0 rounded-full bg-current"></span>
                        <span class="truncate">{{ $item['label'] }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- 4. Generate Laporan BKD (// TODO: connect to BKD reporting controller) --}}
        <button
            type="button"
            x-on:click="selectFeature('laporan-bkd', 'Generate Laporan BKD')"
            x-bind:aria-current="activeMenu === 'laporan-bkd' ? 'page' : false"
            x-bind:class="activeMenu === 'laporan-bkd'
                ? 'border-l-[3px] border-primary bg-[#EEF2FF] font-medium text-primary dark:border-sky-400 dark:bg-slate-800 dark:text-sky-300'
                : 'text-ink hover:bg-[#F3F4F6] dark:text-slate-100 dark:hover:bg-slate-800/70'"
            class="btn-interactive flex min-h-[46px] w-full items-center gap-4 px-5 text-left text-[15px] lg:min-h-[52px] lg:px-7 lg:text-[17px]"
        >
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-sm bg-teal-50 text-teal-800 dark:bg-slate-800 dark:text-teal-300">
                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </span>
            <span x-show="sidebarOpen" class="flex-1 truncate">Generate Laporan BKD</span>
        </button>

        {{-- 5. Review & Approve KRS (// TODO: connect to KRS approval controller) --}}
        <button
            type="button"
            x-on:click="selectFeature('review-krs', 'Review & Approve KRS')"
            x-bind:aria-current="activeMenu === 'review-krs' ? 'page' : false"
            x-bind:class="activeMenu === 'review-krs'
                ? 'border-l-[3px] border-primary bg-[#EEF2FF] font-medium text-primary dark:border-sky-400 dark:bg-slate-800 dark:text-sky-300'
                : 'text-ink hover:bg-[#F3F4F6] dark:text-slate-100 dark:hover:bg-slate-800/70'"
            class="btn-interactive flex min-h-[46px] w-full items-center gap-4 px-5 text-left text-[15px] lg:min-h-[52px] lg:px-7 lg:text-[17px]"
        >
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-sm bg-emerald-50 text-emerald-800 dark:bg-slate-800 dark:text-emerald-300">
                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <span x-show="sidebarOpen" class="flex-1 truncate">Review &amp; Approve KRS</span>
        </button>

        {{-- 6. Layanan Mahasiswa (Collapsible Group) --}}
        <div>
            <button
                type="button"
                x-on:click="toggleGroup('layanan')"
                x-bind:aria-expanded="openGroups.layanan.toString()"
                class="btn-interactive flex min-h-[46px] w-full items-center gap-4 px-5 text-left text-[15px] text-ink hover:bg-[#F3F4F6] lg:min-h-[52px] lg:px-7 lg:text-[17px] dark:text-slate-100 dark:hover:bg-slate-800/70"
            >
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-sm bg-amber-50 text-amber-800 dark:bg-slate-800 dark:text-amber-300">
                    <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                <span x-show="sidebarOpen" class="flex-1 truncate">Layanan Mahasiswa</span>
                <svg
                    x-show="sidebarOpen"
                    aria-hidden="true"
                    class="h-[18px] w-[18px] shrink-0 text-ink-muted transition-transform duration-200 dark:text-slate-300"
                    x-bind:class="{ 'rotate-180': openGroups.layanan }"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </button>

            <div x-show="sidebarOpen && openGroups.layanan" x-cloak class="space-y-1 py-1">
                <button
                    type="button"
                    x-on:click="selectFeature('tiket-layanan', 'Tiket Layanan Mahasiswa')"
                    x-bind:class="activeMenu === 'tiket-layanan'
                        ? 'bg-[#EEF2FF] font-medium text-primary dark:bg-slate-800 dark:text-sky-300'
                        : 'text-[#4B5563] hover:bg-[#F3F4F6] hover:text-primary dark:text-slate-300 dark:hover:bg-slate-800/60 dark:hover:text-white'"
                    class="btn-interactive flex min-h-[44px] w-full items-center gap-2.5 pl-[62px] pr-5 text-left text-sm lg:pl-[74px] lg:text-base"
                >
                    <span aria-hidden="true" class="h-1.5 w-1.5 shrink-0 rounded-full bg-current"></span>
                    <span class="truncate">Tiket Bantuan &amp; Konsultasi</span>
                </button>
            </div>
        </div>

        {{-- 7. Lihat Transkrip Mahasiswa --}}
        <button
            type="button"
            x-on:click="selectFeature('transkrip', 'Lihat Transkrip Mahasiswa')"
            x-bind:aria-current="activeMenu === 'transkrip' ? 'page' : false"
            x-bind:class="activeMenu === 'transkrip'
                ? 'border-l-[3px] border-primary bg-[#EEF2FF] font-medium text-primary dark:border-sky-400 dark:bg-slate-800 dark:text-sky-300'
                : 'text-ink hover:bg-[#F3F4F6] dark:text-slate-100 dark:hover:bg-slate-800/70'"
            class="btn-interactive flex min-h-[46px] w-full items-center gap-4 px-5 text-left text-[15px] lg:min-h-[52px] lg:px-7 lg:text-[17px]"
        >
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-sm bg-blue-50 text-blue-800 dark:bg-slate-800 dark:text-blue-300">
                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </span>
            <span x-show="sidebarOpen" class="flex-1 truncate">Lihat Transkrip Mahasiswa</span>
        </button>

        {{-- 8. Data Mahasiswa --}}
        <button
            type="button"
            x-on:click="selectFeature('data-mahasiswa', 'Data Mahasiswa')"
            x-bind:aria-current="activeMenu === 'data-mahasiswa' ? 'page' : false"
            x-bind:class="activeMenu === 'data-mahasiswa'
                ? 'border-l-[3px] border-primary bg-[#EEF2FF] font-medium text-primary dark:border-sky-400 dark:bg-slate-800 dark:text-sky-300'
                : 'text-ink hover:bg-[#F3F4F6] dark:text-slate-100 dark:hover:bg-slate-800/70'"
            class="btn-interactive flex min-h-[46px] w-full items-center gap-4 px-5 text-left text-[15px] lg:min-h-[52px] lg:px-7 lg:text-[17px]"
        >
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-sm bg-rose-50 text-rose-800 dark:bg-slate-800 dark:text-rose-300">
                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
            </span>
            <span x-show="sidebarOpen" class="flex-1 truncate">Data Mahasiswa</span>
        </button>

        {{-- 9. Pengumuman & Informasi Akademik --}}
        <button
            type="button"
            x-on:click="selectFeature('pengumuman', 'Pengumuman & Informasi Akademik')"
            x-bind:aria-current="activeMenu === 'pengumuman' ? 'page' : false"
            x-bind:class="activeMenu === 'pengumuman'
                ? 'border-l-[3px] border-primary bg-[#EEF2FF] font-medium text-primary dark:border-sky-400 dark:bg-slate-800 dark:text-sky-300'
                : 'text-ink hover:bg-[#F3F4F6] dark:text-slate-100 dark:hover:bg-slate-800/70'"
            class="btn-interactive flex min-h-[46px] w-full items-center gap-4 px-5 text-left text-[15px] lg:min-h-[52px] lg:px-7 lg:text-[17px]"
        >
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-sm bg-orange-50 text-orange-800 dark:bg-slate-800 dark:text-orange-300">
                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                </svg>
            </span>
            <span x-show="sidebarOpen" class="flex-1 truncate">Pengumuman &amp; Info Akademik</span>
        </button>
    </nav>
</aside>
