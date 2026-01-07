@extends('layouts.app')
@section('title', 'Checkout')

@php
    $subtotal = 0;
@endphp

@foreach($cartProducts as $index => $product)
    @php
        $itemTotal = $product['price'] * $product['quantity'];
        $subtotal += $itemTotal;
    @endphp
@endforeach

<!-- Your KHQR Modal with Enhanced Success Animation -->
<div id="khqrModal" class="khqr-modal">
    <div class="khqr-card">
        <button class="khqr-close" onclick="closeModal()">×</button>

        <!-- Updated Bakong Logo (official square) -->
        <img src="https://static.tildacdn.one/tild3133-3762-4664-b634-653566333735/bakong-square.png" alt="Bakong Logo" class="khqr-logo">

        <div class="khqr-tag">BAKONG KHQR PAYMENT</div>

        <p class="khqr-amount">${{ number_format($subtotal, 2) }}</p>

        <!-- Content Wrapper - QR and Success overlap -->
        <div class="khqr-content-wrapper">
            <!-- QR Code -->
            <div class="khqr-qr-wrapper" id="qrWrapper">
                <img id="khqrImg" src="" alt="KHQR Code">
            </div>

            <!-- Success State -->
            <div class="khqr-success-wrapper" id="successWrapper">
                <div class="success-circle">
                    <svg class="checkmark" viewBox="0 0 100 100">
                        <circle class="checkmark-circle" cx="50" cy="50" r="44" />
                        <path class="checkmark-tick" d="M28 50 L44 66 L72 34" />
                    </svg>
                </div>
                <div class="success-text">
                    <h3>Payment Successful!</h3>
                    <p>Thank you for your purchase 🎉</p>
                </div>
            </div>
        </div>

        <!-- Status Box -->
        <div class="khqr-status-box" id="khqrStatusBox">
            <div class="khqr-waiting" id="waitingDots">
                <span></span><span></span><span></span>
            </div>
            <p id="khqrStatus" style="margin: 0.5rem 0 0 0;">Waiting for payment confirmation...</p>
        </div>
    </div>
</div>

<style>
    /* Modal Base - keeping your style */
    .khqr-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
        justify-content: center;
        align-items: center;
        z-index: 9999;
        padding: 1rem;
    }

    .khqr-card {
        max-width: 420px;
        width: 100%;
        background: #ffffff;
        border-radius: 24px;
        padding: 2.5rem 2rem;
        text-align: center;
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.18);
        overflow: hidden;
        position: relative;
    }

    .khqr-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: #f5f5f5;
        border: none;
        font-size: 1.5rem;
        color: #888;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }
    .khqr-close:hover {
        background: #ffebee;
        color: #d32f2f;
    }

    .khqr-logo {
        display: block;
        margin: -30px auto 0;
        width: 100px;
    }

    .khqr-tag {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #e3f2fd;
        color: #1976d2;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        border-radius: 30px;
        margin-bottom: 1.5rem;
    }

    .khqr-amount {
        font-size: 2.8rem;
        font-weight: 700;
        margin: 0 0 2rem 0;
        color: #1976d2;
    }

    /* Content wrapper */
    .khqr-content-wrapper {
        position: relative;
        min-height: 340px;
        margin-bottom: 1.5rem;
    }

    .khqr-qr-wrapper {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 20px;
        border: 2px dashed #ddd;
        opacity: 1;
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .khqr-qr-wrapper.hide {
        opacity: 0;
        transform: translateX(-50%) scale(0.85);
    }
    .khqr-qr-wrapper img {
        width: 260px;
        height: 260px;
        display: block;
    }

    /* Success wrapper */
    .khqr-success-wrapper {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0.8);
        display: flex;
        flex-direction: column;
        align-items: center;
        opacity: 0;
        transition: opacity 0.7s ease, transform 0.7s ease;
        pointer-events: none;
    }
    .khqr-success-wrapper.show {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
        pointer-events: auto;
    }

    .success-circle {
        position: relative;
        width: 150px;
        height: 150px;
        margin-bottom: 1.5rem;
    }

    .checkmark-circle {
        fill: #4caf50;
        stroke: #4caf50;
        stroke-width: 4;
        stroke-dasharray: 280;
        stroke-dashoffset: 280;
        animation: drawCircle 0.9s ease forwards;
    }

    .checkmark-tick {
        fill: none;
        stroke: #fff;
        stroke-width: 7;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 80;
        stroke-dashoffset: 80;
        animation: drawTick 0.6s 0.6s ease forwards;
    }

    @keyframes drawCircle { to { stroke-dashoffset: 0; } }
    @keyframes drawTick { to { stroke-dashoffset: 0; } }

    /* Glow pulse */
    .success-circle::before {
        content: '';
        position: absolute;
        inset: -15px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(76,175,80,0.35) 0%, transparent 70%);
        animation: glowPulse 2s ease-in-out infinite;
    }
    @keyframes glowPulse {
        0%, 100% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.15); opacity: 0.9; }
    }

    .success-text h3 {
        font-size: 1.6rem;
        color: #2e7d32;
        margin: 0 0 0.5rem 0;
        font-weight: 600;
    }
    .success-text p {
        font-size: 1.1rem;
        color: #555;
        margin: 0;
    }

    /* Status box */
    .khqr-status-box {
        background: #e3f2fd;
        border: 1px solid #bbdefb;
        padding: 1.25rem;
        border-radius: 16px;
        font-size: 0.95rem;
        color: #1565c0;
        transition: all 0.5s ease;
    }
    .khqr-status-box.success {
        background: #e8f5e9;
        border-color: #a5d6a7;
        color: #2e7d32;
    }

    .khqr-waiting {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: #555;
    }
    .khqr-waiting span {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #1976d2;
        animation: dots 1.4s infinite ease-in-out;
    }
    .khqr-waiting span:nth-child(1) { animation-delay: 0s; }
    .khqr-waiting span:nth-child(2) { animation-delay: 0.2s; }
    .khqr-waiting span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes dots {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Particles */
    .particle {
        position: absolute;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        pointer-events: none;
        animation: particle 1.4s ease-out forwards;
    }
    @keyframes particle {
        to {
            transform: translate(var(--x), var(--y)) scale(0);
            opacity: 0;
        }
    }
</style>

@section('content')
<section style="padding:4rem 0 6rem;">
    <div class="container">
        <div style="margin-bottom:3rem;">
            <h1 style="font-size:2rem; font-weight:600; margin-bottom:0.5rem; letter-spacing:-0.5px;">
                Checkout
            </h1>
            <p style="color:var(--text-muted); font-size:0.9375rem;">Complete your purchase securely</p>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2rem; align-items:start;">
            <div class="card">
                <h2 style="font-size:1.125rem; font-weight:600; margin:0 0 1.5rem 0; letter-spacing:-0.3px;">Shipping Information</h2>
                <!-- Shipping Information Form -->
                <form id="checkoutForm">
                    <div style="margin-bottom:1.25rem;">
                        <label>Full Name</label>
                        <input type="text" id="customer_name" required placeholder="John Doe">
                    </div>
                    <div style="margin-bottom:1.25rem;">
                        <label>Email</label>
                        <input type="email" id="email" required placeholder="john@example.com">
                    </div>
                    <div style="margin-bottom:1.25rem;">
                        <label>Address</label>
                        <input type="text" id="address" required placeholder="123 Main Street, Phnom Penh">
                    </div>
                    <div style="margin-bottom:1.5rem;">
                        <label>Phone (optional)</label>
                        <input type="tel" id="phone" placeholder="+855 12 345 678">
                    </div>

                    <button type="button" class="btn-primary" style="width:100%; padding:1rem; font-size:1rem;" onclick="startKHQR()">
                        Pay with Bakong KHQR
                    </button>
                </form>
            </div>

            <div style="position:sticky; top:140px;">
                <div class="card">
                    <h2 style="font-size:1.125rem; font-weight:600; margin:0 0 1.5rem 0; letter-spacing:-0.3px;">
                        Order Summary
                    </h2>
                        <div style="display:flex; align-items:center; gap:1rem; margin:{{ $index > 0 ? '1.25rem' : '0' }} 0; {{ $index > 0 ? 'padding-top:1.25rem; border-top:1px solid var(--border);' : '' }}">
                            <img src="{{ $product['image'] }}" width="70" style="border-radius:10px; border:1px solid var(--border); display:block;">
                            <div style="flex:1; min-width:0;">
                                <p style="font-weight:600; font-size:0.9375rem; margin:0 0 0.25rem 0; letter-spacing:-0.2px;">
                                    {{ $product['name'] }} x{{ $product['quantity'] }}
                                </p>
                            </div>
                            <p style="font-weight:600; font-size:1rem; margin:0; letter-spacing:-0.3px;">
                                ${{ number_format($itemTotal, 2) }}
                            </p>
                        </div>
                    <hr style="margin:1.5rem 0;">

                    <div style="margin-bottom:1.25rem;">
                        <div style="display:flex; justify-content:space-between; margin-bottom:0.625rem; color:var(--text-muted); font-size:0.9375rem;">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; margin-bottom:0.625rem; color:var(--text-muted); font-size:0.9375rem;">
                            <span>Shipping</span>
                            <span style="color:var(--accent); font-weight:500;">Free</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; color:var(--text-muted); font-size:0.9375rem;">
                            <span>Tax</span>
                            <span>$0.00</span>
                        </div>
                    </div>

                    <div style="display:flex; justify-content:space-between; align-items:baseline; padding:1.25rem; background:var(--bg); border-radius:12px; margin-bottom:1.5rem;">
                        <span style="font-size:0.9375rem; font-weight:500;">Total</span>
                        <span style="font-size:1.75rem; font-weight:600; letter-spacing:-0.5px;">
                            ${{ number_format($subtotal, 2) }}
                        </span>
                    </div>

                    <div style="padding:1rem; background:rgba(0, 102, 255, 0.06); border:1px solid rgba(0, 102, 255, 0.15); border-radius:10px;">
                        <p style="font-size:0.8125rem; color:var(--text-muted); margin:0; text-align:center;">
                            🔒 Secure payment via KHQR Bakong
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
let md5 = null;
let poller = null;
let processed = false; // Prevent duplicate notifications

function closeModal() {
    document.getElementById('khqrModal').style.display = 'none';
    document.getElementById('qrWrapper').classList.remove('hide');
    document.getElementById('successWrapper').classList.remove('show');
    document.getElementById('waitingDots').style.display = 'flex';
    document.getElementById('khqrStatus').innerHTML = 'Waiting for payment confirmation...';
    document.getElementById('khqrStatusBox').classList.remove('success');
    if (poller) clearInterval(poller);
}

async function startKHQR() {
    const name    = document.getElementById('customer_name').value.trim();
    const email   = document.getElementById('email').value.trim();
    const address = document.getElementById('address').value.trim();
    const phone   = document.getElementById('phone').value.trim();

    if (!name || !email || !address) {
        alert('Please fill in name, email, and address.');
        return;
    }

    try {
        const res = await fetch('/khqr/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ amount: {{ $subtotal }} })
        });

        const data = await res.json();
        if (data.error) {
            alert('Error: ' + data.error);
            return;
        }

        md5 = data.md5;
        document.getElementById('khqrImg').src = 
            'https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=' + encodeURIComponent(data.qr);
        document.getElementById('khqrModal').style.display = 'flex';

        poller = setInterval(() => checkPayment(name, email, address, phone), 3000);
    } catch (err) {
        alert('Network error: ' + err.message);
    }
}

async function checkPayment(name, email, address, phone) {
    if (!md5 || processed) return;

    try {
        const res = await fetch(`/khqr/check?md5=${md5}`);
        const data = await res.json();

        if (data.paid) {
            clearInterval(poller);
            processed = true;

            // 1. Send Telegram notification
            await fetch('/notify-telegram', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    customer_name: name,
                    email: email,
                    address: address,
                    phone: phone,
                    total: {{ $subtotal }},
                    items: @json($cartProducts),
                    paid_from_account: data.fromAccountId || 'Unknown',  // <-- Now correctly uses sender
                    paid_to_account: data.toAccountId || 'Unknown',          // <-- Your fixed receiver account 'bakong_account' => env('BAKONG_ACCOUNT', 'chhinchheang_dara@wing'),
                    date: new Date().toLocaleString('en-GB', { 
                        day: '2-digit', month: '2-digit', year: 'numeric', 
                        hour: '2-digit', minute: '2-digit' 
                    })
                })
            });

            // 2. Clear cart
            await fetch('/cart/clear', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });

            // 3. Show success animation
            document.getElementById('qrWrapper').classList.add('hide');
            setTimeout(() => {
                document.getElementById('successWrapper').classList.add('show');
                document.getElementById('waitingDots').style.display = 'none';
                document.getElementById('khqrStatus').innerHTML = '✓ Payment confirmed successfully!';
                document.getElementById('khqrStatusBox').classList.add('success');
                addParticles();

                setTimeout(() => {
                    closeModal();
                    window.location.href = '/'; // or '/thank-you'
                }, 3500);
            }, 600);
        }
    } catch (err) {
        console.error('Polling error:', err);
    }
}

// Your existing addParticles() function stays the same
function addParticles() {
    const colors = ['#4caf50', '#8bc34a', '#ffeb3b', '#ff9800', '#03a9f4', '#e91e63'];
    const container = document.querySelector('.success-circle');
    for (let i = 0; i < 45; i++) {
        const p = document.createElement('div');
        p.className = 'particle';
        p.style.background = colors[Math.floor(Math.random() * colors.length)];
        p.style.left = '50%';
        p.style.top = '50%';
        const angle = Math.random() * Math.PI * 2;
        const velocity = 100 + Math.random() * 100;
        const x = Math.cos(angle) * velocity;
        const y = Math.sin(angle) * velocity;
        p.style.setProperty('--x', x + 'px');
        p.style.setProperty('--y', y + 'px');
        container.appendChild(p);
        setTimeout(() => p.remove(), 1400);
    }
}
</script>
@endsection