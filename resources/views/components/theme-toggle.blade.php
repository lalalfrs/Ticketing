@props(['variant' => 'default'])

{{--
    MNC University Eagle Theme Toggle Switch:
    Clicking launches the MNC eagle across the sky track from left (Light/Day) to right (Dark/Night)
    with a parabolic flight arc and wing-flapping animation.
--}}
<button
    type="button"
    role="switch"
    x-on:click="toggleTheme()"
    x-bind:aria-checked="dark.toString()"
    x-bind:aria-label="dark ? 'Mode gelap aktif, klik untuk terbang ke mode terang' : 'Mode terang aktif, klik untuk terbang ke mode gelap'"
    aria-label="Toggle tema terang atau gelap"
    class="group relative inline-flex h-11 w-[88px] shrink-0 items-center rounded-full border-2 p-1 transition-colors duration-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 motion-reduce:transition-none"
    x-bind:class="dark
        ? 'border-sky-300 bg-[#071330] focus-visible:ring-sky-300 focus-visible:ring-offset-slate-900'
        : 'border-[#1D4ED8] bg-[#DBEAFE] shadow-inner focus-visible:ring-primary focus-visible:ring-offset-white'"
>
    <span class="sr-only" x-text="dark ? 'Mode Gelap' : 'Mode Terang'">Mode Terang</span>

    {{-- Sky scenery inside track: Crescent Moon & Stars on Left (visible in Dark mode), Sun & Cloud on Right (visible in Light mode) --}}
    <span
        aria-hidden="true"
        class="pointer-events-none absolute inset-y-0 left-2.5 flex items-center transition-opacity duration-300"
        x-bind:class="dark ? 'opacity-100' : 'opacity-0'"
    >
        <svg class="h-4 w-4 text-amber-300" viewBox="0 0 24 24" fill="currentColor">
            <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79Z" />
        </svg>
        <span class="ml-0.5 h-1 w-1 rounded-full bg-sky-200"></span>
    </span>

    <span
        aria-hidden="true"
        class="pointer-events-none absolute inset-y-0 right-2.5 flex items-center transition-opacity duration-300"
        x-bind:class="dark ? 'opacity-0' : 'opacity-100'"
    >
        <svg class="h-4 w-4 text-amber-600" viewBox="0 0 24 24" fill="currentColor">
            <circle cx="12" cy="12" r="5" />
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41m11.32-11.32l1.41-1.41" />
        </svg>
    </span>

    {{-- Wind trail effect while the MNC eagle is mid-flight across the toggle --}}
    <span
        aria-hidden="true"
        x-show="flying"
        x-cloak
        class="pointer-events-none absolute inset-x-3 top-1/2 h-0.5 -translate-y-1/2 rounded-full bg-gradient-to-r from-transparent via-sky-300/80 to-transparent"
    ></span>

    {{-- Flying MNC Eagle Thumb --}}
    <span
        aria-hidden="true"
        class="eagle-carrier relative z-10 flex h-8 w-8 items-center justify-center rounded-full shadow-md"
        x-bind:class="[
            dark ? 'translate-x-[44px] bg-sky-400 text-[#071330]' : 'translate-x-0 bg-primary text-white',
            flying && dark ? 'eagle-fly-right' : '',
            flying && !dark ? 'eagle-fly-left' : ''
        ]"
    >
        {{-- Heraldic MNC Eagle SVG silhouette with flapping wings on click --}}
        <svg
            viewBox="0 0 64 52"
            fill="currentColor"
            class="h-6 w-6 transition-transform duration-200 group-hover:scale-110"
            x-bind:class="{
                'eagle-wings-flapping': flying,
                '-scale-x-100': !dark && flying
            }"
        >
            {{-- Spread Eagle Wings + Head + Fountain Pen Tail matching MNC University Logo --}}
            <path d="M2 6C11 11 19 16 25 20L25 32C18 30 11 26 5 20C8 20 11 20 14 19C9 16 4 12 2 6Z" />
            <path d="M62 6C53 11 45 16 39 20L39 32C46 30 53 26 59 20C56 20 53 20 50 19C55 16 60 12 62 6Z" />
            <path d="M27 16L30 7L26 7L34 4L39 4L35 8L37 16Z" />
            <path d="M25 18H39V31C39 35 35.5 38.5 32 40C28.5 38.5 25 35 25 31V18ZM28 22V31H31.2V22H28ZM32.8 22V31H36V22H32.8Z" />
            <path d="M29 40L25 47L31 51V45.5C30.1 45.2 29.5 44.4 29.5 43.5C29.5 42.4 30.6 41.5 32 41.5C33.4 41.5 34.5 42.4 34.5 43.5C34.5 44.4 33.9 45.2 33 45.5V51L39 47L35 40H29Z" />
        </svg>
    </span>
</button>
