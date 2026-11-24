<x-guest-layout title="Login Page">
    <div class="flex flex-col items-center text-center">
        <img
            src="{{ asset('images/mnc-logo-text.png') }}"
            alt="MNC University"
            width="529"
            height="472"
            fetchpriority="high"
            class="h-16 w-auto md:h-20 dark:brightness-0 dark:invert"
        >

        <h1 class="mt-3 text-lg font-medium text-primary md:text-[22px] dark:text-white">
            Login Page
        </h1>
    </div>

    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form
        method="POST"
        action="{{ route('login') }}"
        class="mt-5 space-y-4"
        x-data="{ submitting: false, showPassword: false }"
        x-on:submit="submitting = true"
        novalidate
    >
        @csrf

        <div>
            <label for="login" class="block text-sm font-medium text-ink dark:text-slate-100">
                Username atau email
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
                    'mt-1.5 block h-11 w-full rounded-md border bg-white px-4 text-sm text-ink placeholder:text-ink-muted shadow-sm transition-colors focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary md:text-base dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400 dark:focus:border-sky-400 dark:focus:ring-sky-400',
                    'border-slate-500 dark:border-slate-400' => ! $errors->has('login'),
                    'border-rose-700 dark:border-rose-400' => $errors->has('login'),
                ])
                @if ($errors->has('login')) aria-invalid="true" aria-describedby="login-error" @endif
            >
            @error('login')
                <p id="login-error" role="alert" class="mt-1.5 text-[13px] font-medium text-rose-900 dark:text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-ink dark:text-slate-100">
                Password
            </label>
            <div class="relative mt-1.5">
                <input
                    id="password"
                    name="password"
                    x-bind:type="showPassword ? 'text' : 'password'"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Masukkan password"
                    @class([
                        'block h-11 w-full rounded-md border bg-white pl-4 pr-12 text-sm text-ink placeholder:text-ink-muted shadow-sm transition-colors focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary md:text-base dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-400 dark:focus:border-sky-400 dark:focus:ring-sky-400',
                        'border-slate-500 dark:border-slate-400' => ! $errors->has('password'),
                        'border-rose-700 dark:border-rose-400' => $errors->has('password'),
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
                    class="absolute inset-y-0 right-0 my-auto flex h-11 w-11 items-center justify-center rounded-sm text-ink-secondary transition-colors hover:bg-slate-100 hover:text-primary focus:outline-none focus-visible:ring-2 focus-visible:ring-primary active:bg-slate-200 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white dark:focus-visible:ring-sky-400"
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
                <p id="password-error" role="alert" class="mt-1.5 text-[13px] font-medium text-rose-900 dark:text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <label for="remember_me" class="inline-flex min-h-[44px] items-center gap-3">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="h-5 w-5 rounded-[6px] border-slate-500 text-primary focus:ring-2 focus:ring-primary dark:border-slate-400 dark:bg-slate-900 dark:focus:ring-sky-400 dark:focus:ring-offset-slate-900"
            >
            <span class="text-sm text-ink-secondary dark:text-slate-200">Ingat saya di perangkat ini</span>
        </label>

        <button
            type="submit"
            x-bind:disabled="submitting"
            class="flex h-11 w-full items-center justify-center gap-2 rounded-md bg-primary px-5 text-sm font-semibold text-white transition-colors hover:bg-primary-hover focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 active:bg-[#08173D] disabled:bg-slate-500 md:text-base dark:bg-sky-400 dark:text-slate-950 dark:hover:bg-sky-300 dark:focus-visible:ring-sky-300 dark:focus-visible:ring-offset-slate-900 dark:active:bg-sky-500 dark:disabled:bg-slate-700 dark:disabled:text-slate-300"
        >
            <svg x-show="submitting" x-cloak aria-hidden="true" class="h-5 w-5 animate-spin motion-reduce:animate-none" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity="0.3" stroke-width="3" />
                <path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
            </svg>
            <span x-text="submitting ? 'Memeriksa akun...' : 'Masuk ke Portal'">Masuk ke Portal</span>
        </button>
        <p class="sr-only" aria-live="polite" x-text="submitting ? 'Memeriksa akun, mohon tunggu.' : ''"></p>
    </form>
</x-guest-layout>
