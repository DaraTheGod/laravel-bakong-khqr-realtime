<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    private function products()
    {
        return [
            [
                'id' => 1,
                'name' => 'Neon Cyber-Headphones',
                'price' => 0.01,
                'image' => 'https://cyber-techwear.com/cdn/shop/products/FuturisticCyberpunkWatch_10_5f1ae9d2-b24c-42c2-8e08-8fb8d9ad3559.jpg?v=1676045066', // Updated to cyber watch style
                'description' => 'Immersive audio with glowing neon accents and noise-cancellation from the future.'
            ],
            [
                'id' => 2,
                'name' => 'Holographic Smart Watch',
                'price' => 0.01,
                'image' => 'https://thumbs.dreamstime.com/b/futuristic-setup-features-various-electronic-devices-including-laptop-tablets-smartphones-headphones-smartwatch-422586541.jpg',
                'description' => 'Holo-display, AI assistant, and biometric tracking in one sleek wrist device.'
            ],
            [
                'id' => 3,
                'name' => 'Quantum Platform Sneakers',
                'price' => 0.01,
                'image' => 'https://cyber-techwear.com/cdn/shop/files/cyberpunk-black-platform-sneakers_6.webp?v=1710496435',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
        ];
    }

    public function index()
    {
        return view('home', ['products' => $this->products()]);
    }

    public function detail($id)
    {
        $product = collect($this->products())->firstWhere('id', (int)$id);
        if (!$product) abort(404);
        return view('product.detail', compact('product'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = collect($this->products())->firstWhere('id', (int)$id);
        if (!$product) abort(404);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = $product;
            $cart[$id]['quantity'] = 1; // explicitly set
        }

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function increase(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $request->session()->put('cart', $cart);
        }
        return redirect()->route('cart');
    }

    public function decrease(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        } elseif (isset($cart[$id]) && $cart[$id]['quantity'] == 1) {
            unset($cart[$id]); // Remove if qty becomes 0
        }
        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    public function removeFromCart(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$id]);
        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    public function cart(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        // Fix old items without quantity
        foreach ($cart as $id => &$item) {
            if (!isset($item['quantity'])) {
                $item['quantity'] = 1;
            }
        }
        unset($item); // break reference

        $request->session()->put('cart', $cart);

        $cartProducts = collect($cart);
        $cartTotal = $cartProducts->sum(fn($item) => $item['price'] * ($item['quantity'] ?? 1));

        return view('cart', compact('cartProducts', 'cartTotal'));
    }

    public function checkout(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart');

        $cartProducts = collect($cart);
        $cartTotal = $cartProducts->sum('price');

        return view('checkout', compact('cartProducts', 'cartTotal'));
    }
}