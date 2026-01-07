@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<section style="padding:4rem 0 6rem;">
    <div class="container">
        <div style="margin-bottom:3rem;">
            <h1 style="font-size:2rem; font-weight:600; margin-bottom:0.5rem; letter-spacing:-0.5px;">
                Shopping Cart
            </h1>
            <p style="color:var(--text-muted); font-size:0.9375rem;">Review your items</p>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
            <div style="display:grid; grid-template-columns:1.75fr 1fr; gap:2rem; align-items:start;">
                <div>
                    <div class="card" style="padding:0;">
                        @foreach($cartProducts as $index => $item)
                        <div style="display:flex; align-items:center; gap:1.5rem; padding:1.5rem; {{ $index > 0 ? 'border-top:1px solid var(--border);' : '' }}">
                            <div style="border-radius:12px; overflow:hidden; width:100px; height:100px; flex-shrink:0; background:var(--bg);">
                                <img src="{{ $item['image'] }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                            </div>
                            <div style="flex:1; min-width:0;">
                                <h3 style="font-size:1rem; font-weight:600; margin:0 0 1.25rem 0; letter-spacing:-0.3px;">{{ $item['name'] }}</h3>
                                <!-- <p style="color:var(--text-muted); font-size:0.875rem; margin:0;">Premium quality</p> -->
                                <div style="display:flex; align-items:center; gap:0.5rem; border:1px solid var(--border); border-radius:8px; overflow:hidden; width:fit-content;">
                                    <form action="{{ route('cart.decrease', $item['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" style="padding:0.5rem 0.75rem; background:none; border:none; font-size:1rem; cursor:pointer;">–</button>
                                    </form>
                                    <input type="text" value="{{ $item['quantity'] }}" readonly style="width:40px; text-align:center; border:none; background:transparent; font-weight:600; padding:0.5rem 0;">
                                    <form action="{{ route('cart.increase', $item['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" style="padding:0.5rem 0.75rem; background:none; border:none; font-size:1rem; cursor:pointer;">+</button>
                                    </form>
                                </div>
                            </div>
                            <div style="text-align:right; display:flex; flex-direction:column; align-items:end; gap:1rem;">
                                <p style="font-size:1.125rem; font-weight:600; padding:0 0 0.5rem 0; letter-spacing:-0.3px;">
                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                </p>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background:none; border:none; color:red; font-weight:semi-bold; font-size:1.5rem; padding:0 0.5rem 0 0; cursor:pointer; transition:color 0.2s ease; display:flex; align-items:center; justify-content:center;" onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='var(--text-muted)'">
                                        ✕
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div style="position:sticky; top:140px;">
                    <div class="card">
                        <h2 style="font-size:1.125rem; font-weight:600; margin:0 0 1.5rem 0; letter-spacing:-0.3px;">Order Summary</h2>
                        
                        <div style="margin-bottom:1.5rem;">
                            <div style="display:flex; justify-content:space-between; margin-bottom:0.75rem; color:var(--text-muted); font-size:0.9375rem;">
                                <span>Subtotal</span>
                                <span>${{ number_format($cartTotal, 2) }}</span>
                            </div>
                            <div style="display:flex; justify-content:space-between; margin-bottom:0.75rem; color:var(--text-muted); font-size:0.9375rem;">
                                <span>Shipping</span>
                                <span style="color:var(--accent); font-weight:500;">Free</span>
                            </div>
                            <div style="display:flex; justify-content:space-between; color:var(--text-muted); font-size:0.9375rem;">
                                <span>Tax</span>
                                <span>$0.00</span>
                            </div>
                        </div>

                        <hr style="border:none; border-top:1px solid var(--border); margin:1.5rem 0;">
                        
                        <div style="display:flex; justify-content:space-between; align-items:baseline; margin-bottom:1.5rem;">
                            <span style="font-size:0.9375rem; font-weight:500;">Total</span>
                            <span style="font-size:1.75rem; font-weight:600; letter-spacing:-0.5px;">
                                ${{ number_format($cartTotal, 2) }}
                            </span>
                        </div>
                        
                        <a href="{{ route('checkout') }}" class="btn-primary" style="width:100%; padding:1rem; text-align:center; display:block;">
                            Checkout
                        </a>

                        <!-- <div style="margin-top:1.5rem; padding:1rem; background:var(--bg); border-radius:10px; text-align:center;">
                            <p style="font-size:0.8125rem; color:var(--text-muted); margin:0;">
                                🔒 Secure payment via KHQR
                            </p>
                        </div> -->
                    </div>
                </div>
            </div>
        @else
            <div class="card" style="text-align:center; padding:4rem 2rem;">
                <div style="font-size:4rem; margin-bottom:1rem; opacity:0.3;">🛒</div>
                <h2 style="font-size:1.5rem; font-weight:600; margin-bottom:0.75rem; letter-spacing:-0.5px;">Your cart is empty</h2>
                <p style="font-size:0.9375rem; color:var(--text-muted); margin-bottom:2rem;">Start adding products to get started</p>
                <a href="{{ route('home') }}" class="btn-primary" style="padding:1rem 2rem;">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</section>
@endsection