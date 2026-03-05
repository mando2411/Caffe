@extends('layouts.cafe')

@section('title', 'The Amazon Forest Cafe | المنيو')

@section('content')
    @php
        $categories = [
            'Coffee & Milk Coffee' => [
                ['name' => 'Americano', 'price' => '15 SAR'],
                ['name' => 'Espresso', 'price' => '8-15 SAR'],
                ['name' => 'Cappuccino', 'price' => '18 SAR'],
                ['name' => 'Latte', 'price' => '20 SAR'],
                ['name' => 'Spanish Latte', 'price' => '22 SAR'],
                ['name' => 'V60', 'price' => '18 SAR'],
                ['name' => 'Turkish Coffee', 'price' => '15 SAR'],
                ['name' => 'Flat White', 'price' => '18 SAR'],
            ],
            'Iced Coffee' => [
                ['name' => 'Iced Latte', 'price' => '22 SAR'],
                ['name' => 'Iced Spanish Latte', 'price' => '22 SAR'],
                ['name' => 'Iced Mocha', 'price' => '22 SAR'],
                ['name' => 'Iced Caramel Latte', 'price' => '22 SAR'],
                ['name' => 'Iced Honey Espresso', 'price' => '22 SAR'],
                ['name' => 'Iced Lemon Espresso', 'price' => '22 SAR'],
                ['name' => 'Iced Red Bull Espresso', 'price' => '25 SAR'],
            ],
            'Fresh Mojito' => [
                ['name' => 'Strawberry Mojito', 'price' => '22 SAR'],
                ['name' => 'Berry Mojito', 'price' => '22 SAR'],
                ['name' => 'Lemon Mint', 'price' => '15 SAR'],
                ['name' => 'Matcha Mojito', 'price' => '22 SAR'],
                ['name' => 'Red Bull Blueberry', 'price' => '18 SAR'],
            ],
            'Amazon Tea' => [
                ['name' => 'Teapot', 'price' => '25 SAR'],
                ['name' => 'English Tea', 'price' => '10 SAR'],
                ['name' => 'Green Tea', 'price' => '10 SAR'],
                ['name' => 'Mint Tea', 'price' => '10 SAR'],
            ],
            'Cold Drinks' => [
                ['name' => 'Fresh Orange Juice', 'price' => '20 SAR'],
                ['name' => 'Slush (Mango / Strawberry / Orange)', 'price' => '15 SAR'],
                ['name' => 'Coca-Cola / Sprite / Fanta', 'price' => '6 SAR'],
                ['name' => 'Sparkling Water', 'price' => '8 SAR'],
                ['name' => 'Water', 'price' => '2 SAR'],
                ['name' => 'Red Bull', 'price' => '15 SAR'],
            ],
            'Snacks & Desserts' => [
                ['name' => 'Popcorn', 'price' => '15 SAR'],
                ['name' => 'Ice Cream', 'price' => '10 SAR'],
                ['name' => 'Milkshake (Caramel / Oreo / Chocolate)', 'price' => '15 SAR'],
            ],
        ];
    @endphp

    <section class="mx-auto max-w-6xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="text-center" data-reveal>
            <p class="text-xs tracking-[0.26em] text-[#EBC045]">THE AMAZON FOREST MENU</p>
            <h1 class="mt-4 text-4xl font-semibold text-white sm:text-5xl">المنيو الكامل</h1>
            <p class="mx-auto mt-5 max-w-2xl text-slate-300 leading-8">
                أسعار واضحة، أصناف متنوعة، وهوية بصرية متسقة مع طابع المقهى الداكن والذهبي.
            </p>
        </div>

        <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($categories as $categoryName => $items)
                <article class="menu-card" data-reveal>
                    <div class="menu-card-header">
                        <h2>{{ $categoryName }}</h2>
                        <span>{{ count($items) }} items</span>
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
            <h3 class="text-2xl font-semibold text-[#EBC045]">جاهز لتجربة النكهة؟</h3>
            <p class="mt-3 text-slate-200">زورنا اليوم واستمتع بأجواء The Amazon Forest.</p>
            <a href="{{ route('home') }}#contact" class="btn-primary mt-6 inline-flex">احجز زيارتك</a>
        </div>
    </section>
@endsection
