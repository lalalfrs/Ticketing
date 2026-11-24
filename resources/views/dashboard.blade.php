@php
    $currentUser = Auth::user();
    $roleLabel = match ($currentUser->username) {
        'admin' => 'Administrator Sistem',
        'staff' => 'Staf Ticketing & Akademik',
        default => 'Pengguna Internal',
    };
@endphp

<x-app-layout title="Dashboard">
    {{-- Section 6: Page Header per spesifikasi-desain-ui.md --}}
    <x-slot name="header">
        <div class="flex flex-col gap-4 border-b-2 border-primary pb-6 sm:flex-row sm:items-end sm:justify-between dark:border-sky-400">
            <div>
                <h1
                    class="text-lg font-normal text-ink-secondary md:text-2xl lg:text-[28px] dark:text-slate-100"
                    x-text="activeFeatureLabel"
                >
                    Dashboard Utama
                </h1>
                <p class="mt-1.5 text-[13px] text-ink-muted md:text-sm dark:text-slate-300">
                    Selamat datang, <span class="font-medium text-primary dark:text-sky-300">{{ $currentUser->name }}</span>
                    ({{ $roleLabel }} · {{ $currentUser->email }})
                </p>
            </div>

            <div class="flex items-center gap-2.5 sm:text-right">
                <svg aria-hidden="true" class="h-[22px] w-[22px] shrink-0 text-[#4F46E5] dark:text-indigo-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="5" width="18" height="16" rx="2" />
                    <path stroke-linecap="round" d="M16 3v4M8 3v4M3 10h18" />
                </svg>
                <div>
                    <p class="text-base font-semibold leading-tight text-ink lg:text-2xl dark:text-white">
                        2026/2027
                    </p>
                    <p class="text-sm font-medium text-ink-secondary lg:text-lg dark:text-slate-300">
                        Semester Ganjil
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8 lg:space-y-10">
        {{-- Active Dummy Feature Panel when user selects a sidebar feature other than Dashboard --}}
        <section
            x-show="activeMenu !== 'dashboard'"
            x-cloak
            aria-live="polite"
            class="rounded-lg border border-primary/30 bg-white p-5 shadow-sm md:p-7 dark:border-sky-400/40 dark:bg-slate-900"
        >
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <span class="inline-flex items-center rounded-sm border border-sky-200 bg-[#F0F9FF] px-2.5 py-1 text-xs font-medium text-[#0369A1] dark:border-sky-800 dark:bg-sky-950 dark:text-sky-200">
                        Modul Dummy (Segera Hadir)
                    </span>
                    <h2 class="mt-2 text-lg font-medium text-ink lg:text-xl dark:text-white" x-text="'Pratinjau Modul: ' + activeFeatureLabel">
                        Pratinjau Modul
                    </h2>
                    <p class="mt-1 text-sm text-ink-secondary dark:text-slate-300">
                        Halaman fitur <span class="font-medium text-primary dark:text-sky-300" x-text="activeFeatureLabel"></span> sedang disiapkan untuk akun <span class="font-medium">{{ $currentUser->username }}</span>. Pilih kembali Dashboard untuk melihat ringkasan utama.
                    </p>
                </div>

                <button
                    type="button"
                    x-on:click="selectFeature('dashboard', 'Dashboard Utama')"
                    class="btn-interactive inline-flex h-11 shrink-0 items-center justify-center rounded-md bg-primary px-4 text-sm font-semibold text-white hover:bg-primary-hover focus:outline-none focus-visible:ring-2 focus-visible:ring-primary dark:bg-sky-400 dark:text-slate-950 dark:hover:bg-sky-300"
                >
                    Kembali ke Dashboard
                </button>
            </div>
        </section>

        {{-- Section 7: Kartu Statistik (4 cards inside 1 container) per spesifikasi-desain-ui.md --}}
        <section aria-label="Ringkasan Statistik Semester Ini" class="rounded-lg border border-line bg-white p-4 shadow-sm md:p-6 dark:border-slate-800 dark:bg-slate-900">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4 xl:gap-5">
                {{-- Card 1: Total Mata Kuliah Diampu --}}
                <button
                    type="button"
                    x-on:click="selectFeature('jadwal', 'Jadwal Perkuliahan')"
                    class="card-interactive group flex w-full flex-col justify-between rounded-md border border-line bg-white p-5 text-left hover:border-purple-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary dark:border-slate-700 dark:bg-slate-900 dark:hover:border-purple-400"
                >
                    <div class="flex items-start gap-4">
                        <span class="flex h-[60px] w-[60px] shrink-0 items-center justify-center rounded-md bg-purple-600/10 text-[#6D28D9] dark:bg-purple-500/20 dark:text-purple-300">
                            <svg aria-hidden="true" class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-ink-secondary lg:text-sm dark:text-slate-300">Total Mata Kuliah Diampu</p>
                            <p class="mt-1 text-[30px] font-medium leading-none text-ink lg:text-[36px] dark:text-white">0</p>
                            <p class="mt-1.5 text-xs text-ink-muted lg:text-[13px] dark:text-slate-400">Semester ini</p>
                        </div>
                    </div>

                    <div class="mt-4 border-t border-line pt-4 dark:border-slate-700">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-ink dark:text-slate-200">Detail</span>
                            <span class="font-medium text-[#6D28D9] group-hover:underline dark:text-purple-300">Lihat &rsaquo;</span>
                        </div>
                        <div class="mt-3 h-1 w-full rounded-full bg-gradient-to-r from-[#8B5CF6] to-[#D946EF]"></div>
                    </div>
                </button>

                {{-- Card 2: Total Mahasiswa Diajar --}}
                <button
                    type="button"
                    x-on:click="selectFeature('data-mahasiswa', 'Data Mahasiswa')"
                    class="card-interactive group flex w-full flex-col justify-between rounded-md border border-line bg-white p-5 text-left hover:border-blue-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary dark:border-slate-700 dark:bg-slate-900 dark:hover:border-sky-400"
                >
                    <div class="flex items-start gap-4">
                        <span class="flex h-[60px] w-[60px] shrink-0 items-center justify-center rounded-md bg-blue-600/10 text-[#1D4ED8] dark:bg-sky-500/20 dark:text-sky-300">
                            <svg aria-hidden="true" class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-ink-secondary lg:text-sm dark:text-slate-300">Total Mahasiswa Diajar</p>
                            <p class="mt-1 text-[30px] font-medium leading-none text-ink lg:text-[36px] dark:text-white">0</p>
                            <p class="mt-1.5 text-xs text-ink-muted lg:text-[13px] dark:text-slate-400">Semester ini</p>
                        </div>
                    </div>

                    <div class="mt-4 border-t border-line pt-4 dark:border-slate-700">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-ink dark:text-slate-200">Detail</span>
                            <span class="font-medium text-[#1D4ED8] group-hover:underline dark:text-sky-300">Lihat &rsaquo;</span>
                        </div>
                        <div class="mt-3 h-1 w-full rounded-full bg-gradient-to-r from-[#0EA5E9] to-[#2563EB]"></div>
                    </div>
                </button>

                {{-- Card 3: Total SKS Diampu --}}
                <button
                    type="button"
                    x-on:click="selectFeature('review-krs', 'Review & Approve KRS')"
                    class="card-interactive group flex w-full flex-col justify-between rounded-md border border-line bg-white p-5 text-left hover:border-emerald-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary dark:border-slate-700 dark:bg-slate-900 dark:hover:border-emerald-400"
                >
                    <div class="flex items-start gap-4">
                        <span class="flex h-[60px] w-[60px] shrink-0 items-center justify-center rounded-md bg-emerald-600/10 text-[#047857] dark:bg-emerald-500/20 dark:text-emerald-300">
                            <svg aria-hidden="true" class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-ink-secondary lg:text-sm dark:text-slate-300">Total SKS Diampu</p>
                            <p class="mt-1 text-[30px] font-medium leading-none text-ink lg:text-[36px] dark:text-white">0</p>
                            <p class="mt-1.5 text-xs text-ink-muted lg:text-[13px] dark:text-slate-400">Semester ini</p>
                        </div>
                    </div>

                    <div class="mt-4 border-t border-line pt-4 dark:border-slate-700">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-ink dark:text-slate-200">Detail</span>
                            <span class="font-medium text-[#047857] group-hover:underline dark:text-emerald-300">Lihat &rsaquo;</span>
                        </div>
                        <div class="mt-3 h-1 w-full rounded-full bg-gradient-to-r from-[#10B981] to-[#14B8A6]"></div>
                    </div>
                </button>

                {{-- Card 4: Total Materi Diunggah --}}
                <button
                    type="button"
                    x-on:click="selectFeature('kelola-materi', 'Kelola Materi & Presensi')"
                    class="card-interactive group flex w-full flex-col justify-between rounded-md border border-line bg-white p-5 text-left hover:border-rose-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary dark:border-slate-700 dark:bg-slate-900 dark:hover:border-rose-400"
                >
                    <div class="flex items-start gap-4">
                        <span class="flex h-[60px] w-[60px] shrink-0 items-center justify-center rounded-md bg-rose-600/10 text-[#BE123C] dark:bg-rose-500/20 dark:text-rose-300">
                            <svg aria-hidden="true" class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-ink-secondary lg:text-sm dark:text-slate-300">Total Materi Diunggah</p>
                            <p class="mt-1 text-[30px] font-medium leading-none text-ink lg:text-[36px] dark:text-white">0</p>
                            <p class="mt-1.5 text-xs text-ink-muted lg:text-[13px] dark:text-slate-400">Semester ini</p>
                        </div>
                    </div>

                    <div class="mt-4 border-t border-line pt-4 dark:border-slate-700">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-ink dark:text-slate-200">Detail</span>
                            <span class="font-medium text-[#BE123C] group-hover:underline dark:text-rose-300">Lihat &rsaquo;</span>
                        </div>
                        <div class="mt-3 h-1 w-full rounded-full bg-gradient-to-r from-[#F43F5E] to-[#EC4899]"></div>
                    </div>
                </button>
            </div>
        </section>

        {{-- Section 8: Jadwal Kuliah Hari Ini per spesifikasi-desain-ui.md --}}
        <section aria-labelledby="jadwal-heading" class="rounded-lg border border-line bg-white p-5 shadow-sm lg:p-[30px] dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h2 id="jadwal-heading" class="text-base font-medium text-ink lg:text-xl dark:text-white">
                        Jadwal Kuliah Hari Ini
                    </h2>
                    <p class="mt-1 text-[13px] text-ink-secondary lg:text-base dark:text-slate-300">
                        Ringkasan jadwal perkuliahan untuk hari ini.
                    </p>

                    {{-- Interactive UI state switcher to preview Empty / Sample Dummy / Loading / Error states (section 12.1) --}}
                    <div class="mt-3 flex flex-wrap gap-2" role="group" aria-label="Simulasi status jadwal">
                        <button
                            type="button"
                            x-on:click="scheduleState = 'empty'"
                            x-bind:aria-pressed="(scheduleState === 'empty').toString()"
                            x-bind:class="scheduleState === 'empty' ? 'bg-primary text-white dark:bg-sky-400 dark:text-slate-950' : 'bg-subtle text-ink-secondary hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200'"
                            class="btn-interactive min-h-[44px] rounded-sm border border-slate-400 px-3 text-xs font-medium dark:border-slate-600"
                        >
                            State Kosong
                        </button>
                        <button
                            type="button"
                            x-on:click="scheduleState = 'populated'"
                            x-bind:aria-pressed="(scheduleState === 'populated').toString()"
                            x-bind:class="scheduleState === 'populated' ? 'bg-primary text-white dark:bg-sky-400 dark:text-slate-950' : 'bg-subtle text-ink-secondary hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200'"
                            class="btn-interactive min-h-[44px] rounded-sm border border-slate-400 px-3 text-xs font-medium dark:border-slate-600"
                        >
                            Contoh Data Dummy
                        </button>
                        <button
                            type="button"
                            x-on:click="scheduleState = 'loading'"
                            x-bind:aria-pressed="(scheduleState === 'loading').toString()"
                            x-bind:class="scheduleState === 'loading' ? 'bg-primary text-white dark:bg-sky-400 dark:text-slate-950' : 'bg-subtle text-ink-secondary hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200'"
                            class="btn-interactive min-h-[44px] rounded-sm border border-slate-400 px-3 text-xs font-medium dark:border-slate-600"
                        >
                            State Loading
                        </button>
                        <button
                            type="button"
                            x-on:click="scheduleState = 'error'"
                            x-bind:aria-pressed="(scheduleState === 'error').toString()"
                            x-bind:class="scheduleState === 'error' ? 'bg-primary text-white dark:bg-sky-400 dark:text-slate-950' : 'bg-subtle text-ink-secondary hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200'"
                            class="btn-interactive min-h-[44px] rounded-sm border border-slate-400 px-3 text-xs font-medium dark:border-slate-600"
                        >
                            State Error
                        </button>
                    </div>
                </div>

                {{-- Badge "Total" per section 2.1 & 8 --}}
                <div class="flex h-16 min-w-[68px] flex-col items-center justify-center self-start rounded-sm border border-[#E0F2FE] bg-[#F0F9FF] px-3 text-[#0369A1] dark:border-sky-800 dark:bg-sky-950 dark:text-sky-200">
                    <span class="text-[11px] font-normal lg:text-[13px]">Total</span>
                    <span class="text-lg font-semibold leading-tight lg:text-2xl" x-text="scheduleState === 'populated' ? '1' : '0'">0</span>
                </div>
            </div>

            {{-- Empty state (default per screenshot & section 8) --}}
            <div
                x-show="scheduleState === 'empty'"
                class="mt-5 rounded-sm border border-line bg-subtle p-6 text-center dark:border-slate-700 dark:bg-slate-800/60"
            >
                <p class="text-sm font-normal text-ink lg:text-base dark:text-slate-100">
                    Tidak ada jadwal kuliah untuk hari ini.
                </p>
                <p class="mt-1 text-xs text-ink-muted lg:text-[13px] dark:text-slate-300">
                    Nikmati waktunya, cek lagi besok ya.
                </p>
            </div>

            {{-- Populated state with explicitly labeled dummy preview item per section 8.1 --}}
            <div
                x-show="scheduleState === 'populated'"
                x-cloak
                class="mt-5 rounded-sm border border-line bg-white p-4 dark:border-slate-700 dark:bg-slate-800"
            >
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <span class="inline-block rounded-sm bg-amber-100 px-2 py-0.5 text-xs font-medium text-amber-900 dark:bg-amber-950 dark:text-amber-200">
                            [DATA DUMMY CONTOH]
                        </span>
                        <p class="mt-1 text-sm font-medium text-ink lg:text-base dark:text-white">
                            08:00 - 10:30 · Pemrograman Web Lanjut
                        </p>
                        <p class="text-xs text-ink-muted lg:text-[13px] dark:text-slate-300">
                            Kelas A · Ruang 3.04 · 3 SKS
                        </p>
                    </div>
                    <button
                        type="button"
                        x-on:click="selectFeature('kelola-materi', 'Kelola Materi & Presensi')"
                        class="btn-interactive inline-flex h-11 items-center justify-center rounded-md bg-primary px-4 text-sm font-semibold text-white hover:bg-primary-hover dark:bg-sky-400 dark:text-slate-950"
                    >
                        Masuk Kelas
                    </button>
                </div>
            </div>

            {{-- Loading state per section 12.1 --}}
            <div
                x-show="scheduleState === 'loading'"
                x-cloak
                role="status"
                aria-live="polite"
                class="mt-5 rounded-sm border border-line bg-subtle p-6 dark:border-slate-700 dark:bg-slate-800/60"
            >
                <div class="mx-auto max-w-md space-y-3 text-center">
                    <div class="mx-auto h-4 w-3/4 animate-pulse rounded-sm bg-slate-300 motion-reduce:animate-none dark:bg-slate-700"></div>
                    <div class="mx-auto h-3 w-1/2 animate-pulse rounded-sm bg-slate-300 motion-reduce:animate-none dark:bg-slate-700"></div>
                    <p class="text-xs text-ink-secondary dark:text-slate-300">Memuat jadwal perkuliahan hari ini...</p>
                </div>
            </div>

            {{-- Error state per section 12.1 --}}
            <div
                x-show="scheduleState === 'error'"
                x-cloak
                role="alert"
                class="mt-5 rounded-sm border border-rose-300 bg-rose-50 p-6 text-center dark:border-rose-800 dark:bg-rose-950/50"
            >
                <p class="text-sm font-medium text-rose-900 dark:text-rose-200">
                    Gagal memuat jadwal perkuliahan hari ini.
                </p>
                <p class="mt-1 text-xs text-rose-800 dark:text-rose-300">
                    Periksa koneksi jaringan internal atau muat ulang jadwal.
                </p>
                <button
                    type="button"
                    x-on:click="scheduleState = 'empty'"
                    class="btn-interactive mt-3 inline-flex h-11 items-center justify-center rounded-md bg-rose-800 px-4 text-xs font-semibold text-white hover:bg-rose-900 dark:bg-rose-400 dark:text-slate-950"
                >
                    Coba lagi
                </button>
            </div>

            <div class="mt-5 h-1 w-full rounded-full bg-[#EEF2F7] dark:bg-slate-800"></div>
        </section>

        {{-- Section 9: Presensi Mahasiswa & Kegiatan Perkuliahan --}}
        <section aria-label="Presensi dan Kegiatan Perkuliahan" class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-[30px]">
            {{-- Card 1: Presensi Mahasiswa --}}
            <div class="flex flex-col justify-between rounded-lg border border-line bg-white p-[22px] shadow-sm lg:p-[30px] dark:border-slate-800 dark:bg-slate-900">
                <div>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-base font-medium text-ink lg:text-xl dark:text-white">
                                Presensi Mahasiswa
                            </h2>
                            <p class="mt-1 text-[13px] text-ink-secondary lg:text-base dark:text-slate-300">
                                Persentase kehadiran mahasiswa pada semester aktif.
                            </p>
                        </div>

                        <div class="flex min-w-[78px] flex-col items-center justify-center rounded-sm border border-[#EDE9FE] bg-[#F5F3FF] px-3 py-2 text-[#6D28D9] dark:border-purple-800 dark:bg-purple-950 dark:text-purple-200">
                            <span class="text-[11px] lg:text-[13px]">Kehadiran</span>
                            <span class="text-lg font-semibold lg:text-2xl">0%</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center justify-between text-xs font-medium text-ink-secondary lg:text-sm dark:text-slate-300">
                            <span>Progress</span>
                            <span>0%</span>
                        </div>
                        <div
                            role="progressbar"
                            aria-label="Persentase kehadiran mahasiswa"
                            aria-valuenow="0"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            class="mt-2 h-2 w-full overflow-hidden rounded-full bg-[#EEF2F7] dark:bg-slate-800"
                        >
                            <div class="h-full w-0 rounded-full bg-[#6D28D9]"></div>
                        </div>
                        <p class="mt-2 text-xs text-ink-muted lg:text-[13px] dark:text-slate-300">
                            Belum ada mahasiswa yang melakukan presensi
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <button
                            type="button"
                            x-on:click="selectFeature('kelola-materi', 'Kelola Materi & Presensi')"
                            class="btn-interactive inline-flex h-12 items-center justify-center rounded-[10px] bg-[#6D28D9] px-5 text-sm font-semibold text-white hover:bg-[#5B21B6] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#6D28D9] focus-visible:ring-offset-2 lg:text-base"
                        >
                            Rekap Presensi
                        </button>
                        <span class="text-xs text-ink-muted lg:text-sm dark:text-slate-300">
                            Lihat ringkasan &amp; detail
                        </span>
                    </div>
                    <div class="mt-4 h-1 w-full rounded-full bg-gradient-to-r from-[#7C3AED] to-[#D946EF]"></div>
                </div>
            </div>

            {{-- Card 2: Kegiatan Perkuliahan --}}
            <div class="flex flex-col justify-between rounded-lg border border-[#FED7AA] bg-white p-[22px] shadow-sm lg:p-[30px] dark:border-orange-900/70 dark:bg-slate-900">
                <div>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-base font-medium text-ink lg:text-xl dark:text-white">
                                Kegiatan Perkuliahan
                            </h2>
                            <p class="mt-1 text-[13px] text-ink-secondary lg:text-base dark:text-slate-300">
                                Realisasi pertemuan perkuliahan hingga akhir semester.
                            </p>
                        </div>

                        <div class="flex min-w-[78px] flex-col items-center justify-center rounded-sm border border-[#FFEDD5] bg-[#FFF7ED] px-3 py-2 text-[#C2410C] dark:border-orange-800 dark:bg-orange-950 dark:text-orange-200">
                            <span class="text-[11px] lg:text-[13px]">Terlaksana</span>
                            <span class="text-lg font-semibold lg:text-2xl">0%</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center justify-between text-xs font-medium text-ink-secondary lg:text-sm dark:text-slate-300">
                            <span>Progress</span>
                            <span>0%</span>
                        </div>
                        <div
                            role="progressbar"
                            aria-label="Persentase kegiatan perkuliahan terlaksana"
                            aria-valuenow="0"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            class="mt-2 h-2 w-full overflow-hidden rounded-full bg-[#EEF2F7] dark:bg-slate-800"
                        >
                            <div class="h-full w-0 rounded-full bg-[#C2410C]"></div>
                        </div>
                        <p class="mt-2 text-xs text-ink-muted lg:text-[13px] dark:text-slate-300">
                            Belum ada kegiatan perkuliahan
                        </p>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <button
                            type="button"
                            x-on:click="selectFeature('input-rps', 'Input RPS')"
                            class="btn-interactive inline-flex h-12 items-center justify-center rounded-[10px] bg-[#C2410C] px-5 text-sm font-semibold text-white hover:bg-[#9A3412] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#C2410C] focus-visible:ring-offset-2 lg:text-base"
                        >
                            Lihat Detail
                        </button>
                        <span class="text-xs text-ink-muted lg:text-sm dark:text-slate-300">
                            Pantau realisasi pertemuan
                        </span>
                    </div>
                    <div class="mt-4 h-1 w-full rounded-full bg-gradient-to-r from-[#F97316] to-[#F59E0B]"></div>
                </div>
            </div>
        </section>

        {{-- Section 10: Quick Action (3 shortcut cards) per spesifikasi-desain-ui.md --}}
        <section aria-label="Pintasan Cepat" class="grid grid-cols-1 gap-5 md:grid-cols-3 lg:gap-[30px]">
            <a
                href="#input-nilai"
                x-on:click.prevent="selectFeature('input-nilai', 'Input Nilai')"
                class="card-interactive flex h-[130px] flex-col items-center justify-center rounded-md border border-line bg-white p-4 text-center shadow-sm hover:border-purple-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary lg:h-[155px] dark:border-slate-800 dark:bg-slate-900 dark:hover:border-purple-400"
            >
                <span class="mb-3 flex h-[52px] w-[52px] items-center justify-center rounded-md bg-purple-600/10 text-[#6B21A8] dark:bg-purple-500/20 dark:text-purple-300">
                    <svg aria-hidden="true" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </span>
                <span class="text-lg font-medium text-[#6B21A8] lg:text-[22px] dark:text-purple-300">
                    Input Nilai
                </span>
            </a>

            <a
                href="#kelola-materi"
                x-on:click.prevent="selectFeature('kelola-materi', 'Kelola Materi & Presensi')"
                class="card-interactive flex h-[130px] flex-col items-center justify-center rounded-md border border-line bg-white p-4 text-center shadow-sm hover:border-orange-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary lg:h-[155px] dark:border-slate-800 dark:bg-slate-900 dark:hover:border-orange-400"
            >
                <span class="mb-3 flex h-[52px] w-[52px] items-center justify-center rounded-md bg-orange-600/10 text-[#C2410C] dark:bg-orange-500/20 dark:text-orange-300">
                    <svg aria-hidden="true" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="2" y="3" width="20" height="14" rx="2" />
                        <path stroke-linecap="round" d="M8 21h8M12 17v4" />
                    </svg>
                </span>
                <span class="text-lg font-medium text-[#C2410C] lg:text-[22px] dark:text-orange-300">
                    Kelola Materi
                </span>
            </a>

            <a
                href="#laporan-bkd"
                x-on:click.prevent="selectFeature('laporan-bkd', 'Generate Laporan BKD')"
                class="card-interactive flex h-[130px] flex-col items-center justify-center rounded-md border border-line bg-white p-4 text-center shadow-sm hover:border-teal-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary lg:h-[155px] dark:border-slate-800 dark:bg-slate-900 dark:hover:border-teal-400"
            >
                <span class="mb-3 flex h-[52px] w-[52px] items-center justify-center rounded-md bg-teal-600/10 text-[#1F6E7A] dark:bg-teal-500/20 dark:text-teal-300">
                    <svg aria-hidden="true" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </span>
                <span class="text-lg font-medium text-[#1F6E7A] lg:text-[22px] dark:text-teal-300">
                    Laporan BKD
                </span>
            </a>
        </section>
    </div>
</x-app-layout>
