<x-guest-layout title="Login Page">
    <div class="grid w-full grid-cols-1 items-center gap-8 lg:grid-cols-12 lg:gap-12">
        {{-- Left Column: Brand Lockup, Bold Welcome Headline, and Internal Portal Description --}}
        <section class="text-left lg:col-span-7 lg:pr-6">
            <div class="inline-flex items-center gap-3.5">
                <img
                    src="{{ asset('images/mnc-logo.png') }}"
                    alt="Logo MNC University"
                    width="557"
                    height="448"
                    fetchpriority="high"
                    class="h-11 w-auto brightness-0 invert md:h-14"
                >
                <div class="leading-tight">
                    <p class="text-lg font-bold tracking-wide text-white md:text-2xl">
                        MNC UNIVERSITY
                    </p>
                    <p class="text-xs font-medium text-sky-200 md:text-sm">
                        Portal Internal Pekerja
                    </p>
                </div>
            </div>

            <h1 class="mt-5 text-4xl font-bold leading-[1.08] tracking-tight text-white sm:text-5xl lg:mt-7 lg:text-[56px]">
                <span class="block">WELCOME</span>
                <span class="mt-1 block text-sky-200">INTERNAL PORTAL</span>
            </h1>

            <p class="mt-4 max-w-xl text-base font-medium leading-snug text-white md:text-xl lg:mt-5">
                Pusat Pengajuan Fitur serta Pengembangan Web &amp; Aplikasi Internal MNC University.
            </p>

            <p class="mt-3 max-w-xl text-xs leading-relaxed text-slate-200 md:text-sm lg:text-[15px]">
                Website khusus bagi pekerja internal MNC University untuk mengajukan penambahan fitur pada web maupun aplikasi yang sudah ada, serta mengusulkan pembuatan web atau aplikasi baru yang perlu ditambahkan untuk menunjang kebutuhan kerja.
            </p>
        </section>

        {{-- Right Column: Frosted Glassmorphism Login Card without Forgot Password, Google Sign-In, or Sign-Up --}}
        <section aria-label="Form Login" class="w-full lg:col-span-5">
            <div class="auth-glass mx-auto w-full max-w-[420px] rounded-lg px-6 py-7 sm:px-8 sm:py-9 lg:ml-auto lg:mr-0">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="space-y-5"
                    x-data="{ submitting: false, showPassword: false }"
                    x-on:submit="submitting = true"
                    novalidate
                >
                    @csrf

                    <div>
                        <label for="login" class="block text-sm font-medium text-white">
                            Username atau Email
                        </label>
                        <input
                            id="login"
                            name="login"
                            type="text"
                            value="{{ old('login') }}"
                            required
                            autofocus
                            autocomplete="username"
                            autocapitalize="none"
                            spellcheck="false"
                            placeholder="Masukkan username atau email"
                            @class([
                                'mt-2 block h-12 w-full rounded-md border bg-white px-4 text-sm text-ink placeholder:text-ink-muted shadow-sm transition-colors focus:border-sky-300 focus:outline-none focus:ring-2 focus:ring-sky-300 md:text-base dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400',
                                'border-white/90 dark:border-slate-500' => ! $errors->has('login'),
                                'border-rose-300 ring-2 ring-rose-300 dark:border-rose-400' => $errors->has('login'),
                            ])
                            @if ($errors->has('login')) aria-invalid="true" aria-describedby="login-error" @endif
                        >
                        @error('login')
                            <p id="login-error" role="alert" class="mt-1.5 text-[13px] font-medium text-rose-200">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-white">
                            Password
                        </label>
                        <div class="relative mt-2">
                            <input
                                id="password"
                                name="password"
                                x-bind:type="showPassword ? 'text' : 'password'"
                                type="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan password"
                                @class([
                                    'block h-12 w-full rounded-md border bg-white pl-4 pr-12 text-sm text-ink placeholder:text-ink-muted shadow-sm transition-colors focus:border-sky-300 focus:outline-none focus:ring-2 focus:ring-sky-300 md:text-base dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400',
                                    'border-white/90 dark:border-slate-500' => ! $errors->has('password'),
                                    'border-rose-300 ring-2 ring-rose-300 dark:border-rose-400' => $errors->has('password'),
                                ])
                                @if ($errors->has('password')) aria-invalid="true" aria-describedby="password-error" @endif
                            >
                            <button
                                type="button"
                                x-on:click="showPassword = ! showPassword"
                                x-bind:aria-pressed="showPassword.toString()"
                                x-bind:aria-label="showPassword ? 'Sembunyikan password' : 'Tampilkan password'"
                                aria-label="Tampilkan password"
                                aria-controls="password"
                                class="btn-interactive absolute inset-y-0 right-0.5 my-auto flex h-11 w-11 items-center justify-center rounded-sm text-ink-secondary hover:bg-slate-100 hover:text-primary focus:outline-none focus-visible:ring-2 focus-visible:ring-primary dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
                            >
                                <svg x-show="! showPassword" aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg x-show="showPassword" x-cloak aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.6 10.6a2 2 0 0 0 2.8 2.8M9.9 4.7A9.8 9.8 0 0 1 12 4.5c6 0 9.75 7.5 9.75 7.5a17 17 0 0 1-3.2 4.2M6.6 6.6C3.9 8.4 2.25 12 2.25 12s3.75 7.5 9.75 7.5a9.6 9.6 0 0 0 5.4-1.6" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p id="password-error" role="alert" class="mt-1.5 text-[13px] font-medium text-rose-200">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            x-bind:disabled="submitting"
                            class="btn-interactive flex h-12 w-full items-center justify-center gap-2 rounded-md bg-[#2563EB] px-5 text-sm font-semibold tracking-wide text-white shadow-sm hover:bg-[#1D4ED8] focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-primary active:bg-[#1E40AF] disabled:bg-slate-600 disabled:text-slate-300 md:text-base"
                        >
                            <svg x-show="submitting" x-cloak aria-hidden="true" class="h-5 w-5 animate-spin motion-reduce:animate-none" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity="0.3" stroke-width="3" />
                                <path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            <span x-text="submitting ? 'Memeriksa akun...' : 'SIGN IN'">SIGN IN</span>
                        </button>
                        <p class="sr-only" aria-live="polite" x-text="submitting ? 'Memeriksa akun, mohon tunggu.' : ''"></p>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-guest-layout>
