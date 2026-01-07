<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# Laravel KHQR Integration

A Laravel project demonstrating **Bakong KHQR integration** with **realtime payment confirmation**.
This is ideal for e-commerce stores in Cambodia using Bakong.

---

## Project Structure

* **Controllers**

  * `ShopController.php` → handles product and cart actions
  * `KHQRController.php` → handles KHQR creation and payment checking
* **Views**

  * Blade templates for home page, product details, cart (update quantity or remove items), and checkout with Bakong KHQR payment
* **Scripts**

  * Realtime polling for payment confirmation
  * Success animation with particle effects

---

## Setup

1. Clone the repo:

```bash
git clone https://github.com/DaraTheGod/laravel-bakong-khqr-realtime.git
cd laravel-bakong-khqr-realtime
```

2. Install dependencies:

```bash
composer install
npm install
npm run dev
```

3. Copy `.env.example` to `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure environment variables in `.env`:

```env
APP_NAME=Laravel
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

# Bakong KHQR API
BAKONG_TOKEN=your_real_bakong_token
BAKONG_ACCOUNT=your_username@bank
```

> 🔗 Register and get your Bakong API token here: [https://api-bakong.nbc.gov.kh/register](https://api-bakong.nbc.gov.kh/register)

---

## Usage

* Navigate to `/checkout` to see the checkout page.
* Add products to the cart from product pages.
* Click **Place Order** → KHQR modal will appear.
* Wait for realtime payment confirmation. Successful payment triggers the animation and clears the cart.

---

## Run the App Locally

Start the Laravel development server:

```bash
php artisan serve
```

This will start the app at:

```
http://127.0.0.1:8000
```

Open your browser and go to:

```
http://127.0.0.1:8000/checkout
```

## Notes

* This project demonstrates **Bakong KHQR integration in Laravel** with realtime polling — not a production-ready system.
* Make sure your `.env` contains **valid Bakong credentials**.
>>>>>>> d5d22d1cb8bbc5d8b639282428db811327ac822a
