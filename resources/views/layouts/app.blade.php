<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureStore - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root {
            --bg: #fafafa;
            --bg-secondary: #ffffff;
            --text: #0a0a0a;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --accent: #0066ff;
            --accent-hover: #0052cc;
            --shadow: rgba(0, 0, 0, 0.04);
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        header {
            padding: 1.25rem 0;
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.8);
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text);
            text-decoration: none;
            letter-spacing: -0.5px;
            transition: opacity 0.2s ease;
        }
        .logo:hover {
            opacity: 0.7;
        }
        nav {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        nav a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.9375rem;
            transition: color 0.2s ease;
        }
        nav a:hover {
            color: var(--text);
        }
        .cart-icon {
            position: relative;
            font-size: 1.25rem;
            color: var(--text);
            transition: transform 0.2s ease;
        }
        .cart-icon:hover {
            transform: scale(1.05);
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: var(--accent);
            color: white;
            border-radius: 10px;
            min-width: 18px;
            height: 18px;
            font-size: 0.6875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
        }
        main {
            flex: 1;
        }
        footer {
            text-align: center;
            padding: 3rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border);
            background: var(--bg-secondary);
            font-size: 0.875rem;
        }
        .btn-primary {
            background: var(--accent);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
            font-family: inherit;
        }
        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        .card {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 1px 3px var(--shadow);
            transition: all 0.2s ease;
        }
        .card:hover {
            box-shadow: 0 4px 12px var(--shadow);
        }
        input, textarea, select {
            width: 100%;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: var(--bg-secondary);
            color: var(--text);
            font-size: 0.9375rem;
            transition: all 0.2s ease;
            font-family: inherit;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(0, 102, 255, 0.1);
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text);
            font-size: 0.875rem;
        }
        hr {
            border: none;
            border-top: 1px solid var(--border);
            margin: 1.5rem 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="container header-content">
            <a href="{{ route('home') }}" class="logo">Chh.Dara</a>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('home') }}#products">Products</a>
                <a href="{{ route('cart') }}" class="cart-icon" style="position:relative; display:inline-flex; align-items:center; text-decoration:none; color:var(--text); font-size:1.6rem;">
                    🛒
                    @php
                        $cart = session('cart', []);
                        $totalItems = collect($cart)->sum('quantity');
                    @endphp
                    @if($totalItems > 0)
                        <span class="cart-count" style="
                            position: absolute;
                            top: -10px;
                            right: -15px;
                            background: light-blue;
                            color: white;
                            border-radius: 50%;
                            width: 20px;
                            height: 20px;
                            font-size: 0.8rem;
                            font-weight: 600;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            {{ $totalItems }}
                        </span>
                    @endif
                </a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- <p>© 2026 Chhinchheang Dara. All rights reserved.</p> -->
         <p>
            &copy; 2026 Laravel Bakong KHQR Realtime Payment. Built by
            <a
              href="https://daraportfolio.vercel.app/"
              target="_blank"
              rel="noopener noreferrer"
              className="text-blue-600 hover:underline"
            >
              Chhinchheang Dara
            </a>
            All rights reserved.
          </p>
    </footer>
</body>
</html>