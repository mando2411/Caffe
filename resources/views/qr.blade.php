@extends('layouts.cafe')

@section('title', __('messages.qr.title'))

@section('content')
    <style>
        .qr-fallback-stage {
            position: relative;
            max-width: 860px;
            margin: 0 auto;
            min-height: calc(100vh - 220px);
            padding: 1.25rem 1rem 4rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qr-fallback-welcome {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            z-index: 2;
            transition: opacity 520ms ease, transform 520ms ease;
        }

        .qr-fallback-welcome-text {
            margin: 0;
            color: #ebc045;
            text-align: center;
            text-transform: lowercase;
            letter-spacing: 0.08em;
            font-size: clamp(1.5rem, 5vw, 3.2rem);
            font-weight: 700;
            text-shadow: 0 0 26px rgba(235, 192, 69, 0.5);
            animation: qr-fallback-pulse 1.2s ease-in-out infinite;
        }

        .qr-fallback-panel {
            width: 100%;
            max-width: 740px;
            opacity: 0;
            transform: translateY(20px) scale(0.98);
            pointer-events: none;
            transition: opacity 700ms cubic-bezier(0.16, 1, 0.3, 1), transform 700ms cubic-bezier(0.16, 1, 0.3, 1);
        }

        .qr-fallback-stage.qr-ready .qr-fallback-welcome {
            opacity: 0;
            transform: scale(1.06);
            pointer-events: none;
        }

        .qr-fallback-stage.qr-ready .qr-fallback-panel {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .qr-fallback-brand {
            margin: 0 0 0.8rem;
            text-align: center;
            color: #ebc045;
            letter-spacing: 0.22em;
            font-size: 0.78rem;
            text-transform: uppercase;
        }

        .qr-fallback-subtitle {
            margin: 0;
            text-align: center;
            color: #f8fafc;
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 700;
        }

        .qr-fallback-grid {
            margin-top: 1.8rem;
            display: grid;
            gap: 0.9rem;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .qr-fallback-btn {
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 14px;
            border: 1px solid rgba(235, 192, 69, 0.35);
            background: rgba(3, 37, 61, 0.78);
            color: #e2e8f0;
            min-height: 56px;
            padding: 0.85rem 1rem;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.28);
            transition: transform 260ms ease, border-color 260ms ease, color 260ms ease, background 260ms ease;
        }

        .qr-fallback-btn::before {
            content: '';
            position: absolute;
            inset-inline-start: -120%;
            top: 0;
            width: 70%;
            height: 100%;
            background: linear-gradient(110deg, transparent 0%, rgba(255, 255, 255, 0.28) 50%, transparent 100%);
            transition: inset-inline-start 450ms ease;
        }

        .qr-fallback-btn:hover {
            transform: translateY(-3px);
            border-color: #ebc045;
            color: #ebc045;
            background: rgba(7, 46, 76, 0.95);
        }

        .qr-fallback-btn:hover::before {
            inset-inline-start: 135%;
        }

        .qr-span-2 {
            grid-column: span 2;
        }

        @media (max-width: 640px) {
            .qr-fallback-grid {
                grid-template-columns: 1fr;
            }

            .qr-span-2 {
                grid-column: span 1;
            }
        }

        @keyframes qr-fallback-pulse {
            0%,
            100% {
                text-shadow: 0 0 20px rgba(235, 192, 69, 0.4);
            }
            50% {
                text-shadow: 0 0 42px rgba(235, 192, 69, 0.75);
            }
        }
    </style>

    <section class="qr-fallback-stage" id="qrLandingStage">
        <div class="qr-fallback-welcome" id="qrWelcomeBlock">
            <p class="qr-fallback-welcome-text">{{ __('messages.qr.welcome') }}</p>
        </div>

        <div class="qr-fallback-panel" id="qrActionsPanel">
            <p class="qr-fallback-brand">{{ __('messages.brand.name') }}</p>
            <h1 class="qr-fallback-subtitle">{{ __('messages.qr.subtitle') }}</h1>

            <div class="qr-fallback-grid">
                <a href="{{ route('menu') }}" class="qr-fallback-btn">{{ __('messages.qr.open_menu') }}</a>
                <a href="tel:+966500000000" class="qr-fallback-btn">{{ __('messages.qr.call_waiter') }}</a>
                <a href="https://wa.me/966500000000?text={{ urlencode(__('messages.qr.order_online')) }}" class="qr-fallback-btn" target="_blank" rel="noopener noreferrer">{{ __('messages.qr.order_online') }}</a>
                <a href="mailto:hello@amazonforest.cafe?subject={{ urlencode(__('messages.qr.rate_us')) }}" class="qr-fallback-btn">{{ __('messages.qr.rate_us') }}</a>
                <a href="mailto:hello@amazonforest.cafe?subject={{ urlencode(__('messages.qr.suggest_us')) }}" class="qr-fallback-btn qr-span-2">{{ __('messages.qr.suggest_us') }}</a>
            </div>
        </div>
    </section>

    <noscript>
        <style>
            #qrWelcomeBlock {
                display: none !important;
            }
            #qrActionsPanel {
                opacity: 1 !important;
                transform: none !important;
                pointer-events: auto !important;
            }
        </style>
    </noscript>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stage = document.getElementById('qrLandingStage');
            if (!stage) {
                return;
            }

            window.setTimeout(function () {
                stage.classList.add('qr-ready');
            }, 2100);
        });
    </script>
@endsection
