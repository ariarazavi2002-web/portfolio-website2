# Aria Razavi — Product Designer Portfolio (Daya Creative Studio)

A production-ready, framework-free personal portfolio built with **plain PHP 8.2+**, semantic **HTML5**, modern **CSS3**, and **vanilla JavaScript**. Engineered according to a **Feature-Based MVC Modular Monolith** architecture specifically optimized for standard Linux shared hosting (cPanel with Apache and MySQL).

---

## 🏛 Architecture Overview

The codebase is organized as an independent Modular Monolith:

```text
portfolio/
│
├── app/
│   ├── Features/                     # Feature-specific modules
│   │   ├── Home/                     # Working initial feature
│   │   │   ├── Controllers/          # HomeController (HTTP orchestrator)
│   │   │   ├── Services/             # HomeService (Business logic)
│   │   │   ├── Models/               # Data access & models
│   │   │   ├── Views/                # Pure presentation templates
│   │   │   └── routes.php            # Feature route definitions
│   │   ├── Projects/                 # Projects feature stub
│   │   ├── About/                    # About feature stub
│   │   ├── Contact/                  # Contact feature stub
│   │   ├── Auth/                     # Auth feature stub
│   │   └── Admin/                    # Admin feature stub
│   │
│   ├── Core/                         # Reusable core infrastructure
│   │   ├── Database.php              # PDO singleton with prepared statements
│   │   ├── Router.php                # Clean URL dispatcher with regex parameters
│   │   ├── Request.php               # Object-oriented HTTP request wrapper
│   │   ├── Response.php              # HTTP response, header & JSON handler
│   │   ├── Middleware.php            # Base middleware interface
│   │   └── View.php                  # Template engine with layouts & components
│   │
│   └── Shared/                       # Cross-feature reusable presentation
│       ├── Views/
│       │   ├── layouts/              # App layout shell (app.php)
│       │   └── components/           # Reusable components (header, footer)
│       └── Helpers/                  # Helpers (escape.php, csrf.php, url.php)
│
├── config/
│   ├── app.php                       # Application configuration
│   └── database.php                  # PDO & database settings
│
├── public/                           # Web-accessible Document Root
│   ├── index.php                     # Central front controller
│   ├── .htaccess                     # Apache rewrite rules & asset bypass
│   └── assets/                       # Static assets
│       ├── css/                      # Modular CSS stylesheets
│       ├── js/                       # Vanilla ES6+ scripts
│       ├── images/                   # Optimized SVGs and image assets
│       └── fonts/                    # Font assets
│
├── storage/
│   ├── logs/                         # Application runtime logs
│   └── cache/                        # Application cache
│
├── bootstrap.php                     # Autoloader & environment bootstrapper
├── .gitignore
└── README.md
```

---

## 🚀 Local Development Setup

### Requirements:
- PHP 8.2 or higher
- PDO MySQL extension (`pdo_mysql`) enabled (if using database)

### Running the Local Server:

From inside the `portfolio/` directory:

```bash
php -S localhost:8000 -t public
```

Or from the project repository root:

```bash
php -S localhost:8000 -t portfolio/public
```

Open `http://localhost:8000` in your browser. The application runs immediately without Composer, Node.js, npm, or any build step.

---

## ⚙️ Configuration & Database

### Application Config (`config/app.php`):
Control debug mode, environment, and timezone using standard PHP configurations or environment variables:
- `APP_ENV`: `production` or `development`
- `APP_DEBUG`: `true` or `false`
- `APP_URL`: Base application URL

### Database Config (`config/database.php`):
Configure MySQL credentials when database features are activated:
- `DB_HOST`: Hostname (default: `127.0.0.1`)
- `DB_PORT`: Port (default: `3306`)
- `DB_DATABASE`: Database name (default: `portfolio`)
- `DB_USERNAME`: Database username
- `DB_PASSWORD`: Database password

Access the database instance anywhere using:
```php
use App\Core\Database;

$pdo = Database::connect();
$stmt = $pdo->prepare('SELECT * FROM projects WHERE id = :id');
$stmt->execute(['id' => 1]);
$project = $stmt->fetch();
```

---

## 🌐 Deployment on Shared Hosting (cPanel / Apache)

For optimal security on cPanel and Apache shared hosting, isolate application source files outside the public web root:

```text
/home/username/
│
├── portfolio/                        # Uploaded outside public web root
│   ├── app/
│   ├── config/
│   ├── storage/
│   └── bootstrap.php
│
└── public_html/                      # Public Document Root
    ├── index.php                     # From portfolio/public/index.php
    ├── .htaccess                     # From portfolio/public/.htaccess
    └── assets/                       # From portfolio/public/assets/
```

### Steps:
1. Upload the `app/`, `config/`, `storage/`, and `bootstrap.php` files into `/home/username/portfolio/`.
2. Upload the contents of `public/` (`index.php`, `.htaccess`, and `assets/`) into `/home/username/public_html/`.
3. `public_html/index.php` contains multi-path resolution that automatically detects `/home/username/portfolio/bootstrap.php` without modifying any code.
4. Verify that `storage/logs/` has write permissions (`0755` or `0775`).
5. Ensure `mod_rewrite` is enabled on your Apache server (standard on cPanel).

---

## 🔒 Security Practices

- **XSS Protection**: Dynamic output is escaped using `e($value)` (`htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`).
- **CSRF Defense**: Session-backed CSRF tokens via `csrf_field()` and `csrf_verify()`.
- **Prepared Statements**: Strict PDO prepared statements with disabled emulation (`ATTR_EMULATE_PREPARES => false`).
- **Sensitive Path Isolation**: Core files and configuration are stored outside `public_html/`. Direct access to hidden files (`.env`, `.git`) is blocked by `.htaccess`.
- **Error Silencing**: In production (`APP_DEBUG=false`), detailed errors are written to `storage/logs/error.log` and hidden from users.
