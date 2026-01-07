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
