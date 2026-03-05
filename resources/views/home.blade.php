@extends('layouts.cafe')

@section('title', __('messages.brand.name').' | '.__('messages.nav.home'))

@section('content')
    <section class="relative overflow-hidden">
        <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:py-24 lg:px-8">
            <div data-reveal>
                <p class="mb-4 text-xs tracking-[0.3em] text-[#EBC045]">{{ __('messages.brand.badge') }}</p>
                <h1 class="text-4xl font-semibold leading-tight text-white sm:text-5xl lg:text-6xl">
                    {{ __('messages.home.title') }}
                    <span class="mt-2 block text-2xl font-medium text-[#EBC045] sm:text-3xl">{{ __('messages.home.subtitle') }}</span>
                </h1>
                <p class="mt-6 max-w-xl text-base leading-8 text-slate-300 sm:text-lg">
                    {{ __('messages.home.description') }}
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ route('menu') }}" class="btn-primary">{{ __('messages.home.cta_menu') }}</a>
                    <a href="#about" class="btn-secondary">{{ __('messages.home.cta_about') }}</a>
                </div>

                <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3">
                    <div class="stat-card" data-reveal>
                        <strong>{{ __('messages.home.stats.items_value') }}</strong>
                        <span>{{ __('messages.home.stats.items_label') }}</span>
                    </div>
                    <div class="stat-card" data-reveal>
                        <strong>{{ __('messages.home.stats.categories_value') }}</strong>
                        <span>{{ __('messages.home.stats.categories_label') }}</span>
                    </div>
                    <div class="stat-card col-span-2 sm:col-span-1" data-reveal>
                        <strong>{{ __('messages.home.stats.fresh_value') }}</strong>
                        <span>{{ __('messages.home.stats.fresh_label') }}</span>
                    </div>
                </div>
            </div>

            <div class="relative" data-reveal>
                <div class="orb orb-gold"></div>
                <div class="orb orb-blue"></div>
                <div class="glass-card p-5 sm:p-7">
                    <img src="{{ route('menu.image') }}" alt="{{ __('messages.home.menu_image_alt') }}" class="menu-preview">
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="mx-auto max-w-6xl px-4 py-6 sm:px-6 lg:px-8 lg:py-10">
        <div class="grid gap-6 lg:grid-cols-3">
            @foreach (__('messages.home.features') as $feature)
                <article class="feature-card" data-reveal>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['description'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="glass-card p-8 text-center sm:p-12" data-reveal>
            <p class="text-xs tracking-[0.25em] text-[#EBC045]">{{ __('messages.home.style_badge') }}</p>
            <h2 class="mt-4 text-3xl font-semibold text-white sm:text-4xl">{{ __('messages.home.style_title') }}</h2>
            <p class="mx-auto mt-4 max-w-2xl leading-8 text-slate-300">
                {{ __('messages.home.style_description') }}
            </p>
            <a href="{{ route('menu') }}" class="btn-primary mt-8 inline-flex">{{ __('messages.home.style_cta') }}</a>
        </div>
    </section>
@endsection
