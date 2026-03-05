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
            transition: opacity 620ms ease, transform 620ms ease;
            padding: 0 1rem;
        }

        .qr-fallback-welcome-card {
            width: min(92vw, 760px);
            border-radius: 24px;
            border: 1px solid rgba(235, 192, 69, 0.32);
            background: radial-gradient(circle at 15% 20%, rgba(235, 192, 69, 0.13), transparent 45%),
                rgba(3, 30, 51, 0.7);
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.42), inset 0 0 0 1px rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(7px);
            padding: clamp(1.2rem, 3vw, 2rem) clamp(1rem, 2.4vw, 2rem);
        }

        .qr-type-row {
            margin: 0;
            text-align: center;
            font-weight: 700;
            overflow-wrap: anywhere;
            word-break: break-word;
            min-height: 1.4em;
        }

        .qr-type-row--one {
            color: #e6edf6;
            letter-spacing: 0.07em;
            font-size: clamp(1rem, 2.4vw, 1.65rem);
        }

        .qr-type-row--two {
            margin-top: 0.38rem;
            color: #ebc045;
            letter-spacing: 0.09em;
            font-size: clamp(1.45rem, 4.8vw, 3.2rem);
            text-shadow: 0 0 18px rgba(235, 192, 69, 0.4);
        }

        .qr-type-row.is-typing::after {
            content: '';
            display: inline-block;
            width: 0.08em;
            height: 0.95em;
            margin-inline-start: 0.18em;
            background: currentColor;
            vertical-align: -0.06em;
            animation: qr-caret-blink 0.75s steps(1) infinite;
        }

        .qr-welcome-caption {
            margin: 0.75rem 0 0;
            text-align: center;
            color: #b9c8d7;
            font-size: 0.87rem;
            letter-spacing: 0.08em;
            opacity: 0.9;
        }

        .qr-welcome-glow {
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(235, 192, 69, 0.26) 0%, rgba(235, 192, 69, 0) 68%);
            filter: blur(12px);
            z-index: -1;
            animation: qr-fallback-pulse 1.8s ease-in-out infinite;
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
            position: relative;
        }

        .qr-fallback-grid.is-loading .qr-fallback-btn {
            opacity: 0.2;
            transform: none;
        }

        .qr-skeleton-layer {
            position: absolute;
            inset: 0;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.9rem;
            z-index: 3;
            opacity: 0;
            pointer-events: none;
            transition: opacity 180ms ease;
        }

        .qr-fallback-grid.is-loading .qr-skeleton-layer {
            opacity: 1;
        }

        .qr-skeleton-item {
            display: block;
            min-height: 56px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.16);
            background: linear-gradient(
                110deg,
                rgba(255, 255, 255, 0.08) 8%,
                rgba(255, 255, 255, 0.24) 20%,
                rgba(255, 255, 255, 0.08) 34%
            );
            background-size: 220% 100%;
            animation: qr-skeleton-shimmer 1.05s linear infinite;
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

            .qr-type-row--one {
                letter-spacing: 0.05em;
                font-size: 1rem;
            }

            .qr-type-row--two {
                letter-spacing: 0.05em;
                font-size: 1.55rem;
            }

            .qr-welcome-caption {
                font-size: 0.74rem;
                letter-spacing: 0.06em;
            }

            .qr-skeleton-layer {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .qr-fallback-btn {
                min-height: 52px;
                font-size: 0.95rem;
                padding-inline: 0.85rem;
            }

            .qr-skeleton-item {
                min-height: 52px;
            }
        }

        @keyframes qr-fallback-pulse {
            0%,
            100% {
                transform: scale(0.96);
                opacity: 0.58;
            }
            50% {
                transform: scale(1.08);
                opacity: 0.95;
            }
        }

        @keyframes qr-caret-blink {
            0%,
            45% {
                opacity: 1;
            }
            50%,
            100% {
                opacity: 0;
            }
        }

        @keyframes qr-skeleton-shimmer {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
    </style>

    <section class="qr-fallback-stage" id="qrLandingStage">
        <div class="qr-fallback-welcome" id="qrWelcomeBlock">
            <span class="qr-welcome-glow" aria-hidden="true"></span>
            <div class="qr-fallback-welcome-card">
                <p class="qr-type-row qr-type-row--one is-typing" id="qrWelcomeLine1" data-text="{{ __('messages.qr.welcome_line_1') }}"></p>
                <p class="qr-type-row qr-type-row--two" id="qrWelcomeLine2" data-text="{{ __('messages.qr.welcome_line_2') }}"></p>
                <p class="qr-welcome-caption">{{ __('messages.qr.subtitle') }}</p>
            </div>
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

            <div class="qr-fallback-grid" id="qrActionGrid">
                <div class="qr-skeleton-layer" aria-hidden="true">
                    <span class="qr-skeleton-item"></span>
                    <span class="qr-skeleton-item"></span>
                    <span class="qr-skeleton-item"></span>
                    <span class="qr-skeleton-item"></span>
                    <span class="qr-skeleton-item qr-span-2"></span>
                </div>

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
            const actionGrid = document.getElementById('qrActionGrid');
            const lineOne = document.getElementById('qrWelcomeLine1');
            const lineTwo = document.getElementById('qrWelcomeLine2');

            if (!stage) {
                return;
            }

            const sleep = function (ms) {
                return new Promise(function (resolve) {
                    window.setTimeout(resolve, ms);
                });
            };

            const typeLine = function (element, text, speed) {
                return new Promise(function (resolve) {
                    if (!element) {
                        resolve();
                        return;
                    }

                    element.textContent = '';
                    element.classList.add('is-typing');

                    let index = 0;
                    const interval = window.setInterval(function () {
                        element.textContent += text.charAt(index);
                        index += 1;

                        if (index >= text.length) {
                            window.clearInterval(interval);
                            element.classList.remove('is-typing');
                            resolve();
                        }
                    }, speed);
                });
            };

            const runWelcomeSequence = async function () {
                if (!lineOne || !lineTwo) {
                    stage.classList.add('qr-ready');
                    return;
                }

                const lineOneText = lineOne.dataset.text || '';
                const lineTwoText = lineTwo.dataset.text || '';

                await typeLine(lineOne, lineOneText, 55);
                await sleep(220);
                await typeLine(lineTwo, lineTwoText, 68);
                await sleep(760);
                stage.classList.add('qr-ready');
            };

            runWelcomeSequence();

            if (!switcher || !openMenuButton) {
                return;
            }

            const buttons = Array.from(switcher.querySelectorAll('[data-layout-mode]'));

            const setLoadingState = function (isLoading) {
                if (!actionGrid) {
                    return;
                }

                actionGrid.classList.toggle('is-loading', isLoading);
                buttons.forEach(function (button) {
                    button.disabled = isLoading;
                });
            };

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
                    const startedAt = Date.now();
                    setLoadingState(true);

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
                        })
                        .finally(function () {
                            const elapsed = Date.now() - startedAt;
                            const remaining = Math.max(0, 420 - elapsed);

                            window.setTimeout(function () {
                                setLoadingState(false);
                            }, remaining);
                        });
                });
            });
        });
    </script>
@endsection
