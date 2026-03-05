<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ str_starts_with(app()->getLocale(), 'ar') ? 'rtl' : 'ltr' }}">
    @php
        $hasViteBuild = file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'));
        $fallbackCssVersion = file_exists(public_path('fallback/app.css'))
            ? filemtime(public_path('fallback/app.css'))
            : time();
        $fallbackJsVersion = file_exists(public_path('fallback/app.js'))
            ? filemtime(public_path('fallback/app.js'))
            : time();
    @endphp
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', __('messages.meta.title_suffix'))</title>
        <meta name="description" content="{{ __('messages.meta.description') }}">

        @if ($hasViteBuild)
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ route('asset.app.css', ['v' => $fallbackCssVersion]) }}">
            <script defer src="{{ route('asset.app.js', ['v' => $fallbackJsVersion]) }}"></script>
        @endif
    </head>
    <body class="cafe-shell text-stone-100">
        <div class="pointer-events-none fixed inset-0 -z-20 bg-[radial-gradient(circle_at_20%_20%,rgba(235,192,69,0.20),transparent_35%),radial-gradient(circle_at_80%_15%,rgba(8,70,131,0.35),transparent_35%),radial-gradient(circle_at_45%_85%,rgba(23,68,65,0.25),transparent_40%)]"></div>
        <div class="grain-overlay"></div>

        <header class="sticky top-0 z-40 border-b border-white/10 bg-[#041625]/80 backdrop-blur-xl">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="group inline-flex min-w-0 items-center gap-2 sm:gap-3">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-[#EBC045]/50 bg-[#032E51] text-[#EBC045] shadow-[0_0_20px_rgba(235,192,69,0.15)]">☕</span>
                    <span class="min-w-0 leading-tight">
                        <strong class="block text-[10px] tracking-[0.11em] text-[#EBC045] sm:text-sm sm:tracking-[0.26em]">{{ __('messages.brand.name') }}</strong>
                        <span class="block truncate text-[10px] text-slate-300/90 sm:text-xs">{{ __('messages.brand.subtitle') }}</span>
                    </span>
                </a>

                <button id="mobile-menu-toggle" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-white/20 text-slate-200 md:hidden" aria-label="Toggle navigation" aria-expanded="false">
                    <span class="text-xl">☰</span>
                </button>

                <nav id="main-nav" class="hidden items-center gap-2 md:flex">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('messages.nav.home') }}</a>
                    <a href="{{ route('menu') }}" class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}">{{ __('messages.nav.menu') }}</a>
                    <a href="{{ route('home') }}#about" class="nav-link">{{ __('messages.nav.about') }}</a>
                    <a href="{{ route('home') }}#contact" class="nav-link">{{ __('messages.nav.contact') }}</a>
                    <div class="inline-flex items-center gap-1 rounded-xl border border-white/15 bg-white/5 px-2 py-1">
                        <a href="{{ route('language.switch', ['locale' => 'ar_SA']) }}" class="rounded-lg px-2 py-1 text-xs transition {{ app()->getLocale() === 'ar_SA' ? 'bg-[#EBC045] text-[#102236]' : 'text-slate-200 hover:bg-white/10' }}">{{ __('messages.language.arabic') }}</a>
                        <a href="{{ route('language.switch', ['locale' => 'en']) }}" class="rounded-lg px-2 py-1 text-xs transition {{ app()->getLocale() === 'en' ? 'bg-[#EBC045] text-[#102236]' : 'text-slate-200 hover:bg-white/10' }}">{{ __('messages.language.english') }}</a>
                    </div>
                </nav>
            </div>

            <nav id="mobile-nav" class="mx-4 mb-4 hidden rounded-2xl border border-white/10 bg-[#052038]/95 p-3 md:hidden">
                <a href="{{ route('home') }}" class="mobile-nav-link">{{ __('messages.nav.home') }}</a>
                <a href="{{ route('menu') }}" class="mobile-nav-link">{{ __('messages.nav.menu') }}</a>
                <a href="{{ route('home') }}#about" class="mobile-nav-link">{{ __('messages.nav.about') }}</a>
                <a href="{{ route('home') }}#contact" class="mobile-nav-link">{{ __('messages.nav.contact') }}</a>
                <div class="mt-2 flex items-center gap-2 px-2">
                    <span class="text-xs text-slate-300">{{ __('messages.language.label') }}:</span>
                    <a href="{{ route('language.switch', ['locale' => 'ar_SA']) }}" class="rounded-lg px-2 py-1 text-xs transition {{ app()->getLocale() === 'ar_SA' ? 'bg-[#EBC045] text-[#102236]' : 'text-slate-200 hover:bg-white/10' }}">{{ __('messages.language.arabic') }}</a>
                    <a href="{{ route('language.switch', ['locale' => 'en']) }}" class="rounded-lg px-2 py-1 text-xs transition {{ app()->getLocale() === 'en' ? 'bg-[#EBC045] text-[#102236]' : 'text-slate-200 hover:bg-white/10' }}">{{ __('messages.language.english') }}</a>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer id="contact" class="mt-20 border-t border-white/10 bg-[#02121f]/90">
            <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 sm:px-6 lg:grid-cols-3 lg:px-8">
                <div>
                    <h3 class="mb-3 text-sm tracking-[0.24em] text-[#EBC045]">{{ __('messages.brand.name') }}</h3>
                    <p class="text-sm leading-7 text-slate-300">
                        {{ __('messages.footer.about') }}
                    </p>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-semibold text-[#EBC045]">{{ __('messages.footer.work_hours') }}</h4>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li>{{ __('messages.footer.everyday') }}</li>
                        <li>{{ __('messages.footer.friday') }}</li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-semibold text-[#EBC045]">{{ __('messages.footer.contact_title') }}</h4>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li>{{ __('messages.footer.phone') }}</li>
                        <li>{{ __('messages.footer.email') }}</li>
                        <li>{{ __('messages.footer.address') }}</li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>
