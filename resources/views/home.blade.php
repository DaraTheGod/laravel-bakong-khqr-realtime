@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="hero" style="text-align:center; padding:6rem 0 5rem;">
    <div class="container">
        <h1 style="font-size:3.5rem; font-weight:700; margin-bottom:1rem; line-height:1.1; letter-spacing:-1px; color:var(--text);">
            Premium tech for modern living
        </h1>
        <p style="font-size:1.125rem; color:var(--text-muted); max-width:560px; margin:0 auto 2.5rem; line-height:1.6;">
            Discover carefully curated technology that seamlessly fits your lifestyle.
        </p>
        <a href="#products" class="btn-primary" style="padding:1rem 2rem; font-size:1rem;">
            Browse Collection
        </a>
    </div>
</section>

<section id="products" style="padding:4rem 0 6rem;">
    <div class="container">
        <div style="margin-bottom:3rem;">
            <h2 style="font-size:2rem; font-weight:600; margin-bottom:0.5rem; letter-spacing:-0.5px;">
                Featured Products
            </h2>
            <p style="color:var(--text-muted); font-size:0.9375rem;">Handpicked items for you</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:1.5rem;">
            @foreach($products as $product)
            <div class="card" style="padding:0; overflow:hidden;">
                <div style="position:relative; background:var(--bg); overflow:hidden;">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" style="width:100%; height:280px; object-fit:cover; display:block;">
                </div>
                <div style="padding:1.5rem;">
                    <h3 style="font-size:1.125rem; font-weight:600; margin:0 0 0.5rem 0; letter-spacing:-0.3px;">{{ $product['name'] }}</h3>
                    <p style="color:var(--text-muted); font-size:0.875rem; margin-bottom:1.25rem; line-height:1.5;">{{ $product['description'] }}</p>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-size:1.5rem; font-weight:600; letter-spacing:-0.5px;">${{ number_format($product['price'], 2) }}</span>
                        <div style="display:flex; gap:0.5rem;">
                            <a href="{{ route('product.detail', $product['id']) }}" style="padding:0.5rem 1rem; font-size:0.875rem; color:var(--text-muted); background:var(--bg); border:1px solid var(--border); border-radius:8px; text-decoration:none; font-weight:500; transition:all 0.2s ease;" onmouseover="this.style.borderColor='var(--text)'; this.style.color='var(--text)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text-muted)'">
                                View
                            </a>
                            <form action="{{ route('cart.add', $product['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-primary" style="padding:0.75rem 1rem; font-size:0.875rem;">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection