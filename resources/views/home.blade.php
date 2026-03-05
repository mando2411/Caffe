@extends('layouts.cafe')

@section('title', 'The Amazon Forest Cafe | الرئيسية')

@section('content')
    <section class="relative overflow-hidden">
        <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:py-24 lg:px-8">
            <div data-reveal>
                <p class="mb-4 text-xs tracking-[0.3em] text-[#EBC045]">PREMIUM JUNGLE INSPIRED CAFE</p>
                <h1 class="text-4xl font-semibold leading-tight text-white sm:text-5xl lg:text-6xl">
                    THE AMAZON FOREST
                    <span class="mt-2 block text-2xl font-medium text-[#EBC045] sm:text-3xl">Coffee, Tea & Signature Mojito</span>
                </h1>
                <p class="mt-6 max-w-xl text-base leading-8 text-slate-300 sm:text-lg">
                    تجربة مقهى متكاملة بطابع غابة أمازون: مزيج ألوان داكن فاخر، مشروبات باردة وساخنة، وحلويات مختارة بدقة.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="{{ route('menu') }}" class="btn-primary">استكشف المنيو</a>
                    <a href="#about" class="btn-secondary">تعرف علينا</a>
                </div>

                <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3">
                    <div class="stat-card" data-reveal>
                        <strong>+45</strong>
                        <span>Menu Items</span>
                    </div>
                    <div class="stat-card" data-reveal>
                        <strong>7</strong>
                        <span>Categories</span>
                    </div>
                    <div class="stat-card col-span-2 sm:col-span-1" data-reveal>
                        <strong>Daily</strong>
                        <span>Fresh Roasting</span>
                    </div>
                </div>
            </div>

            <div class="relative" data-reveal>
                <div class="orb orb-gold"></div>
                <div class="orb orb-blue"></div>
                <div class="glass-card p-5 sm:p-7">
                    <img src="{{ route('menu.image') }}" alt="The Amazon Forest menu preview" class="menu-preview">
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="mx-auto max-w-6xl px-4 py-6 sm:px-6 lg:px-8 lg:py-10">
        <div class="grid gap-6 lg:grid-cols-3">
            <article class="feature-card" data-reveal>
                <h3>Coffee & Milk Coffee</h3>
                <p>Americano, Cappuccino, Latte, V60، وخلطات يومية متوازنة الطعم.</p>
            </article>
            <article class="feature-card" data-reveal>
                <h3>Iced & Mojito</h3>
                <p>مشروبات منعشة مثل Iced Spanish Latte وFresh Mojito بنكهات موسمية.</p>
            </article>
            <article class="feature-card" data-reveal>
                <h3>Desserts & Snacks</h3>
                <p>حلويات وسناكس خفيفة تكمل تجربة القهوة بطابع فاخر ومتناسق.</p>
            </article>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="glass-card p-8 text-center sm:p-12" data-reveal>
            <p class="text-xs tracking-[0.25em] text-[#EBC045]">AMAZON FOREST STYLE</p>
            <h2 class="mt-4 text-3xl font-semibold text-white sm:text-4xl">Dark • Natural • Premium</h2>
            <p class="mx-auto mt-4 max-w-2xl leading-8 text-slate-300">
                الهوية البصرية مبنية على ألوان الكحلي والبترولي والذهبي بدرجات ترابية، مع حركة أنيميشن هادئة تمنح إحساسًا حيًا وفخمًا على جميع الشاشات.
            </p>
            <a href="{{ route('menu') }}" class="btn-primary mt-8 inline-flex">عرض الأسعار الكاملة</a>
        </div>
    </section>
@endsection
