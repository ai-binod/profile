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
