# ICTM Framework 4.5.1 (ICTM Framework 451)

![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)
![Architecture](https://img.shields.io/badge/Architecture-MVC-orange.svg)

The **ICTM Framework** is a lightweight, high-performance PHP MVC (Model-View-Controller) framework designed for speed, simplicity, and flexibility. Unlike heavy frameworks bloated with unnecessary code, ICTM takes a minimalistic approach while offering essential modern web development features.

---

## 🚀 Features

- **Lightweight MVC Architecture**: Clean separation of concerns across Models, Views, and Controllers.
- **Modern PHP Support**: Built for PHP 8.2+ with strict typing (`declare(strict_types=1);`).
- **Flexible Database Engine**: Native support for **MySQL** and **SQLite** via PDO.
- **Custom Expressive Templating**: Simple template parsing syntax using `{{ $variable }}` and `{{ function_name() }}`.
- **Powerful Helper Suite**: Built-in procedural helpers for Flash Messaging, HTML/URL generation, Data Sanitation, and Price Formatting.
- **Clean Routing Engine**: Flexible URI routing supporting `GET`, `POST`, `ANY`, and dynamic parameter wildcards (`{id}`, `{slug}`).
- **Built-in Security**: Automated XSS sanitization (`validate_data()`), prepared PDO statements against SQL Injection, and secure path isolation.

---

## 📂 Project Directory Structure

```text
├── APP/
│   ├── Config/          # Configuration files (Routes, Autoload, Database, Constants)
│   ├── Controllers/     # Controller classes handling request logic (App\Controllers)
│   ├── Filters/         # Request middleware & execution filters
│   ├── Helpers/         # Procedural utility functions (URL, Formatting, Flash)
│   ├── Libraries/       # Custom & third-party classes (App\Libraries)
│   ├── Models/          # Model classes handling DB operations (App\Models)
│   ├── System/          # Core framework engine & base classes (System\Config)
│   ├── Views/           # Application template views
│   └── .env             # Environment configuration file (DB credentials, app keys)
├── public_html/         # Public Web Root (accessible via web browser)
│   ├── css/             # Stylesheets (style.css)
│   ├── js/              # Client-side scripts (script.js)
│   ├── images/          # Image assets
│   ├── Writables/       # Upload & runtime writable storage
│   └── index.php        # Front controller & app entry point
├── Schema.sql           # Database schema & sample seed data
├── composer.json        # Package & autoloader configuration
├── composer.lock        # Locked dependency versions
└── packages.json        # Framework package metadata
```

---

## ⚙️ Requirements & Installation

### Prerequisites
- **PHP**: 8.3 or higher (8.5 recommended) with `PDO`, `pdo_mysql`, and `pdo_sqlite` extensions enabled.
- **Web Server**: Apache (`mod_rewrite` enabled) or Nginx.
- **Composer**: Dependency manager for PHP.

### Setup Instructions

1. **Clone or Extract the Repository**:
   ```bash
   git clone https://github.com/ictmatrics/ICTM_Framework401.git
   cd ICTM_Framework401
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   ```

3. **Configure Environment Variables**:
   Copy `APP/env.example` to `APP/.env` and configure your database and app settings:
   ```ini
   APP_KEY="your-secret-key"
   SITE_NAME="ICTM Products Portal"
   APP_VERSION="1.0.1"

   # Database Connection (mysql or sqlite)
   DB_CONNECTION="sqlite"
   DB_NAME="database.sqlite"
   ```

4. **Import Database Schema**:
   For SQLite, initialize using `Schema.sql`:
   ```bash
   sqlite3 APP/Config/database.sqlite < Schema.sql
   ```
   Or import `Schema.sql` into your MySQL database server.

5. **Run Local Development Server**:
   Point your document root to `public_html/` or use PHP's built-in web server:
   ```bash
   php -S localhost:8000 -t public_html
   ```

---

## 🛣️ Routing Syntax

Routes are defined in `APP/Config/Route.php` using `$router`:

```php
// Basic Routes
$router->get('/', 'HomeController@index');
$router->get('/products', 'ProductController@index');

// Form Actions
$router->get('/products/create', 'ProductController@create');
$router->post('/products/store', 'ProductController@store');

// Dynamic Dynamic Parameters
$router->get('/products/edit/{id}', 'ProductController@edit');
$router->post('/products/update/{id}', 'ProductController@update');
$router->post('/products/delete/{id}', 'ProductController@delete');
```

---

## 🎨 Controllers & Views

### Controller Example
Controllers must extend `System\Config\Controller` and reside in `App\Controllers`:

```php
<?php
declare(strict_types=1);

namespace App\Controllers;

use System\Config\Controller;
use App\Models\ProductModel;

class ProductController extends Controller
{
    private ProductModel $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data['title'] = 'All Products';
        $data['products'] = $this->productModel->getFeaturedProducts();

        echo $this->view('products/index', $data);
    }
}
```

### View Example
Views reside in `APP/Views/` and utilize standard PHP or double curly bracket output expressions `{{ $var }}`:

```html
<h1>{{ $title }}</h1>
<div class="product-list">
    <?php foreach ($products as $product) { ?>
        <div class="product-card">
            <h3><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h3>
            <p>{{ format_price($product->price) }}</p>
            <?php redirectto('products/edit/' . $product->id, 'Edit Product', 'btn btn-primary'); ?>
        </div>
    <?php } ?>
</div>
```

---

## 🛠️ Helpers Reference

The framework autoloads core utility functions from `APP/Helpers/`:

- **URL Helpers** (`url_helper.php`):
  - `redirect(string $page)`: Safe browser redirection.
  - `redirectto(string $page, string $text, string $class)`: Formatted anchor `<a href="..." class="...">` output.
  - `pathto(string $page)`: Returns full absolute URL.
- **Formatting Helpers** (`format_helper.php`):
  - `validate_data(string $data)`: Strips tags & handles XSS sanitization.
  - `format_price(float|int|string $price)`: Currency formatter based on settings.
- **Flash Messages** (`flash_helper.php`):
  - `flash(string $name, string $message, string $class)`: Session-based notification alerts.

---

## 📜 License

Distributed under the **MIT License**. See `LICENSE` for more information.


# Changelog

All notable changes to the **ICTM Framework** project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [4.5.1] - 2026-07-28

### Added
- **Environment Configuration (.env)**: Integrated `.env` environment variable loader via `APP/Helpers/env_helper.php` to securely manage application secrets, database credentials, and mailer settings.
- **Dual Database Support**: Flexible database configuration supporting seamless switching between **MySQL** and **SQLite** engines using `DB_CONNECTION`.
- **Composer & PSR-4 Autoloading**: Introduced `composer.json` and generated `composer.lock` with PSR-4 namespace mapping (`ICTM\Framework451\`).
- **Product CRUD Reference Architecture**: Added complete reference implementation featuring `ProductController`, `ProductModel`, SQLite seed schema (`Schema.sql`), and product management view templates.

### Changed
- **PHP Requirements Upgraded**: Increased minimum PHP version requirement to **PHP 8.3+** (with full PHP 8.5 compatibility).
- **Refactored Constants System**: Updated `APP/Config/Constants.php` to leverage `env()` fallbacks for compile-time constants (`APPKEY`, `SITENAME`, `APPVERSION`, `E_HOST`, etc.).
- **Dynamic BASE_URL Resolution**: Enhanced `BASE_URL` generation to automatically detect SSL/reverse-proxy protocols (`HTTPS` / `HTTP_X_FORWARDED_PROTO`) and clean `public_html` subpaths from redirects.
- **Routing & Rewrite Engine**: Improved `.htaccess` rules in `public_html/` for smoother URI routing and subpath normalization.

### Fixed
- **URL Redirect Leakage**: Resolved path resolution bug where `public_html` was mistakenly appended to internal redirect links.
- **Composer Package Schema**: Standardized package naming to `ictmatrics/ictm-framework451` to comply with Composer JSON schema validation.

---

## [4.0.1] - 2026-06-24

### Added
- **Core Framework Foundation**: Initial release of ICTM Framework 4.0.x lightweight MVC architecture.
- **Base Controllers & Models**: Extended base classes (`System\Config\Controller` and `System\Config\Model`).
- **Procedural Helpers**: Core helper suites (`url_helper.php`, `format_helper.php`, `flash_helper.php`).
- **Templating Engine**: Double curly brace expression evaluation (`{{ $var }}`) in view templates.
- **Dynamic Router**: Native routing engine supporting `GET`, `POST`, and `ANY` HTTP methods with parameter wildcard matching.
