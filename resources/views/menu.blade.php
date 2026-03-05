@extends('layouts.cafe')

@section('title', __('messages.brand.name').' | '.__('messages.nav.menu'))

@section('content')
    @php
        $categories = __('messages.menu.categories');
    @endphp

    <section class="mx-auto max-w-6xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="text-center" data-reveal>
            <p class="text-xs tracking-[0.26em] text-[#EBC045]">{{ __('messages.menu.badge') }}</p>
            <h1 class="mt-4 text-4xl font-semibold text-white sm:text-5xl">{{ __('messages.menu.title') }}</h1>
            <p class="mx-auto mt-5 max-w-2xl text-slate-300 leading-8">
                {{ __('messages.menu.description') }}
            </p>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($categories as $categoryName => $items)
                <article class="menu-card" data-reveal>
                    <div class="menu-card-header">
                        <h2>{{ $categoryName }}</h2>
                        <span>{{ count($items) }} {{ __('messages.menu.items_count_label') }}</span>
                    </div>

                    <ul class="mt-4 space-y-3">
                        @foreach ($items as $item)
                            <li class="menu-item-row">
                                <span>{{ $item['name'] }}</span>
                                <strong>{{ $item['price'] }}</strong>
                            </li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>

        <div class="mt-12 rounded-3xl border border-[#EBC045]/35 bg-[#022036]/60 p-5 text-center backdrop-blur-xl sm:p-8" data-reveal>
            <h3 class="text-2xl font-semibold text-[#EBC045]">{{ __('messages.menu.cta_title') }}</h3>
            <p class="mt-3 text-slate-200">{{ __('messages.menu.cta_description') }}</p>
            <a href="{{ route('home') }}#contact" class="btn-primary mt-6 inline-flex">{{ __('messages.menu.cta_button') }}</a>
        </div>
    </section>
@endsection
