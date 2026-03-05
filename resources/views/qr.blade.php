@extends('layouts.cafe')

@section('title', __('messages.qr.title'))

@section('content')
    <section class="qr-stage mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="qr-welcome-block">
            <p class="qr-welcome-text">{{ __('messages.qr.welcome') }}</p>
        </div>

        <div class="qr-actions-wrapper">
            <p class="mb-6 text-center text-sm tracking-[0.22em] text-[#EBC045]">{{ __('messages.brand.name') }}</p>
            <h1 class="mb-3 text-center text-3xl font-semibold text-white sm:text-4xl">{{ __('messages.qr.subtitle') }}</h1>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <a href="{{ route('menu') }}" class="qr-action-btn">{{ __('messages.qr.open_menu') }}</a>

                <a href="tel:+966500000000" class="qr-action-btn">{{ __('messages.qr.call_waiter') }}</a>

                <a href="https://wa.me/966500000000?text={{ urlencode(__('messages.qr.order_online')) }}" class="qr-action-btn" target="_blank" rel="noopener noreferrer">{{ __('messages.qr.order_online') }}</a>

                <a href="mailto:hello@amazonforest.cafe?subject={{ urlencode(__('messages.qr.rate_us')) }}" class="qr-action-btn">{{ __('messages.qr.rate_us') }}</a>

                <a href="mailto:hello@amazonforest.cafe?subject={{ urlencode(__('messages.qr.suggest_us')) }}" class="qr-action-btn sm:col-span-2">{{ __('messages.qr.suggest_us') }}</a>
            </div>
        </div>
    </section>
@endsection
