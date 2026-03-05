@extends('layouts.cafe')

@section('title', __('messages.qr.title'))

@section('content')
    <style>
        html,
        body {
            overflow-x: hidden;
            width: 100%;
        }

        .qr-fallback-stage {
            position: relative;
            max-width: 860px;
            margin: 0 auto;
            min-height: calc(100vh - 220px);
            padding: 1.25rem 1rem 4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            box-sizing: border-box;
            overflow-x: clip;
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
            letter-spacing: 0.03em;
            font-size: clamp(1.5rem, 5vw, 3.2rem);
            font-weight: 700;
            line-height: 1.35;
            max-width: min(92vw, 680px);
            overflow-wrap: anywhere;
            word-break: break-word;
            text-shadow: 0 0 26px rgba(235, 192, 69, 0.5);
            animation: qr-fallback-pulse 1.2s ease-in-out infinite;
        }

        .qr-fallback-panel {
            width: 100%;
            max-width: 740px;
            opacity: 0;
            transform: translateY(20px) scale(0.98);
            pointer-events: none;
            box-sizing: border-box;
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
            letter-spacing: 0.13em;
            font-size: 0.78rem;
            text-transform: uppercase;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .qr-fallback-subtitle {
            margin: 0;
            text-align: center;
            color: #f8fafc;
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 700;
        }

        .qr-layout-label {
            margin: 1.1rem 0 0.65rem;
            text-align: center;
            color: #cbd5e1;
            font-size: 0.82rem;
            letter-spacing: 0.08em;
        }

        .qr-layout-switcher {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.55rem;
            margin-bottom: 1rem;
        }

        .qr-layout-btn {
            border: 1px solid rgba(235, 192, 69, 0.22);
            background: rgba(2, 27, 45, 0.7);
            color: #e2e8f0;
            min-height: 42px;
            border-radius: 10px;
            padding: 0.45rem 0.55rem;
            font-size: 0.83rem;
            font-weight: 700;
            transition: all 220ms ease;
            cursor: pointer;
        }

        .qr-layout-btn:hover {
            border-color: rgba(235, 192, 69, 0.65);
            color: #ebc045;
            transform: translateY(-1px);
        }

        .qr-layout-btn.is-active {
            border-color: #ebc045;
            background: rgba(235, 192, 69, 0.2);
            color: #ebc045;
            box-shadow: 0 6px 20px rgba(235, 192, 69, 0.2);
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
                gap: 0.75rem;
            }

            .qr-layout-switcher {
                grid-template-columns: 1fr;
                gap: 0.45rem;
                margin-bottom: 0.8rem;
            }

            .qr-span-2 {
                grid-column: span 1;
            }

            .qr-fallback-stage {
                padding-inline: 0.8rem;
                padding-top: 1rem;
            }

            .qr-fallback-brand {
                letter-spacing: 0.08em;
                font-size: 0.7rem;
            }

            .qr-fallback-btn {
                min-height: 52px;
                font-size: 0.95rem;
                padding-inline: 0.85rem;
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
            <p class="qr-layout-label">{{ __('messages.qr.layout_label') }}</p>

            <div class="qr-layout-switcher" id="qrLayoutSwitcher">
                <button type="button" class="qr-layout-btn is-active" data-layout-mode="1">{{ __('messages.qr.layout_1') }}</button>
                <button type="button" class="qr-layout-btn" data-layout-mode="2">{{ __('messages.qr.layout_2') }}</button>
                <button type="button" class="qr-layout-btn" data-layout-mode="3">{{ __('messages.qr.layout_3') }}</button>
            </div>

            <div class="qr-fallback-grid">
                <a href="{{ route('menu') }}" class="qr-fallback-btn" id="qrOpenMenuBtn">{{ __('messages.qr.open_menu') }}</a>
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
            const openMenuButton = document.getElementById('qrOpenMenuBtn');
            const switcher = document.getElementById('qrLayoutSwitcher');

            if (!stage) {
                return;
            }

            window.setTimeout(function () {
                stage.classList.add('qr-ready');
            }, 2100);

            if (!switcher || !openMenuButton) {
                return;
            }

            const buttons = Array.from(switcher.querySelectorAll('[data-layout-mode]'));

            const setActiveMode = function (mode) {
                buttons.forEach(function (button) {
                    const isActive = button.dataset.layoutMode === String(mode);
                    button.classList.toggle('is-active', isActive);
                });
            };

            const fallbackMap = {
                1: { url: '{{ route('menu') }}', target: '_self' },
                2: { url: '{{ route('menu.image') }}', target: '_blank' },
                3: { url: '{{ route('menu.pdf') }}', target: '_blank' },
            };

            const applyMode = function (mode, payload) {
                const state = payload || fallbackMap[mode] || fallbackMap[1];
                openMenuButton.href = state.url;
                openMenuButton.target = state.target;
                openMenuButton.rel = state.target === '_blank' ? 'noopener noreferrer' : '';
                setActiveMode(mode);
            };

            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const mode = Number(button.dataset.layoutMode || '1');

                    fetch(`{{ url('/qr/menu-layout') }}/${mode}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    })
                        .then(function (response) {
                            if (!response.ok) {
                                throw new Error('Request failed');
                            }
                            return response.json();
                        })
                        .then(function (data) {
                            applyMode(mode, data);
                        })
                        .catch(function () {
                            applyMode(mode);
                        });
                });
            });
        });
    </script>
@endsection
