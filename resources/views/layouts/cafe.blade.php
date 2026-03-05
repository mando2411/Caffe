<!DOCTYPE html>
<html lang="ar" dir="rtl">
    @php
        $hasViteBuild = file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'));
    @endphp
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'The Amazon Forest Cafe')</title>
        <meta name="description" content="The Amazon Forest Cafe - Premium coffee, tea, mojito, and desserts with a rich jungle-inspired identity.">

        @if ($hasViteBuild)
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                body {
                    margin: 0;
                    min-height: 100vh;
                    font-family: Arial, sans-serif;
                    background: #021421;
                    color: #fff;
                }
                .asset-warning {
                    margin: 16px;
                    padding: 12px 14px;
                    border: 1px solid #ebc04566;
                    border-radius: 10px;
                    background: #1d2a36;
                    color: #ebc045;
                    font-size: 14px;
                    line-height: 1.6;
                }
            </style>
        @endif
    </head>
    <body class="cafe-shell text-stone-100">
        @unless ($hasViteBuild)
            <div class="asset-warning">
                Frontend assets are not built yet. Please run <strong>npm run build</strong> and upload <strong>public/build</strong>.
            </div>
        @endunless
        <div class="pointer-events-none fixed inset-0 -z-20 bg-[radial-gradient(circle_at_20%_20%,rgba(235,192,69,0.20),transparent_35%),radial-gradient(circle_at_80%_15%,rgba(8,70,131,0.35),transparent_35%),radial-gradient(circle_at_45%_85%,rgba(23,68,65,0.25),transparent_40%)]"></div>
        <div class="grain-overlay"></div>

        <header class="sticky top-0 z-40 border-b border-white/10 bg-[#041625]/80 backdrop-blur-xl">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="group inline-flex items-center gap-3">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-[#EBC045]/50 bg-[#032E51] text-[#EBC045] shadow-[0_0_20px_rgba(235,192,69,0.15)]">☕</span>
                    <span class="leading-tight">
                        <strong class="block text-sm tracking-[0.26em] text-[#EBC045]">THE AMAZON FOREST</strong>
                        <span class="text-xs text-slate-300/90">Cafe & Signature Drinks</span>
                    </span>
                </a>

                <button id="mobile-menu-toggle" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-white/20 text-slate-200 md:hidden" aria-label="Toggle navigation" aria-expanded="false">
                    <span class="text-xl">☰</span>
                </button>

                <nav id="main-nav" class="hidden items-center gap-2 md:flex">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">الرئيسية</a>
                    <a href="{{ route('menu') }}" class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}">المنيو</a>
                    <a href="{{ route('home') }}#about" class="nav-link">عن الكافيه</a>
                    <a href="{{ route('home') }}#contact" class="nav-link">تواصل</a>
                </nav>
            </div>

            <nav id="mobile-nav" class="mx-4 mb-4 hidden rounded-2xl border border-white/10 bg-[#052038]/95 p-3 md:hidden">
                <a href="{{ route('home') }}" class="mobile-nav-link">الرئيسية</a>
                <a href="{{ route('menu') }}" class="mobile-nav-link">المنيو</a>
                <a href="{{ route('home') }}#about" class="mobile-nav-link">عن الكافيه</a>
                <a href="{{ route('home') }}#contact" class="mobile-nav-link">تواصل</a>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer id="contact" class="mt-20 border-t border-white/10 bg-[#02121f]/90">
            <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 sm:px-6 lg:grid-cols-3 lg:px-8">
                <div>
                    <h3 class="mb-3 text-sm tracking-[0.24em] text-[#EBC045]">THE AMAZON FOREST</h3>
                    <p class="text-sm leading-7 text-slate-300">
                        تجربة قهوة بطابع أمازوني فاخر، نكهات مركزة، ومشروبات منعشة، مع هوية بصرية دافئة ومميزة.
                    </p>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-semibold text-[#EBC045]">ساعات العمل</h4>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li>يوميًا: 8:00 ص - 1:00 ص</li>
                        <li>الجمعة: 2:00 م - 2:00 ص</li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-3 text-sm font-semibold text-[#EBC045]">تواصل</h4>
                    <ul class="space-y-2 text-sm text-slate-300">
                        <li>الهاتف: +966 50 000 0000</li>
                        <li>البريد: hello@amazonforest.cafe</li>
                        <li>العنوان: Riyadh, Saudi Arabia</li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>
