# FoodDrop

FoodDrop is a student-level food delivery web app built with Laravel. It lets customers browse restaurants, add menu items to a cart, place orders, and track order status. Admins can manage restaurants, menu items, and orders.

## Requirements

- PHP 8.1+ (tested with PHP 8.3)
- Composer
- SQLite (default) or MySQL

## Setup

1) Install dependencies

```bash
composer install
```

2) Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

3) Create database and seed

```bash
php artisan migrate --seed
```

4) (Optional) If you plan to upload images

```bash
php artisan storage:link
```

5) Run the app

```bash
php artisan serve
```

## Demo Credentials

- Admin: admin@fooddrop.test / password
- Customer: user@fooddrop.test / password

## Main Pages

- Home: list restaurants, search by name, filter by category
- Restaurant page: menu items + add to cart
- Cart: update quantity, remove items, view total
- Checkout: add delivery address + phone, place order
- My Orders: order history and details

## Admin Panel

- Manage Restaurants (CRUD)
- Manage Menu Items (CRUD)
- View Orders + update status

Access admin routes at `/admin` after logging in as admin.

## Screenshots

- Home page: [add screenshot]
- Restaurant menu: [add screenshot]
- Cart: [add screenshot]
- Admin dashboard: [add screenshot]
