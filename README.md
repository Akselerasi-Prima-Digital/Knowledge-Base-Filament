# Knowledge Base Platform

A modern, high-performance content management system designed for internal documentation, help centers, and FAQ management.

<p align="center">
  <img src="https://img.shields.io/badge/version-0.0.1-blue.svg" />
  <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20.svg" />
  <img src="https://img.shields.io/badge/Vue.js-3.x-4FC08D.svg" />
  <a href="LICENSE">
    <img alt="License" src="https://img.shields.io/badge/license-MIT-green.svg" target="_blank" />
  </a>
</p>

## Description

Knowledge Base Platform provides a robust foundation for building self-service support portals and internal company wikis. Built on the Laravel ecosystem and powered by Filament and Inertia.js, it offers a seamless authoring experience with a rich text editor, dynamic media handling, and intuitive categorization. The platform includes enterprise-grade role and permission management out of the box, ensuring secure and scalable content delivery tailored to both public audiences and internal teams. 

## Features

- **Comprehensive Article Management** - Create, edit, and organize articles using an advanced rich text editor with integrated media uploads
- **Dynamic Organization** - Structure content efficiently using flexible categories and tag-based grouping
- **Granular Access Control** - Secure the platform with comprehensive role and permission management powered by Filament Shield
- **Modern User Interface** - Deliver a fast, single-page application experience to end-users through Inertia.js and Vue 3
- **Intuitive Admin Dashboard** - Manage content, users, and system settings via a highly responsive Filament 5 administration panel
- **Storage Optimization** - Automatically identify and clean up unused article images to maintain optimal server storage
- **Multilingual Support** - Native validation and error messaging support for multiple languages, configured by default to Indonesian

## Tech Stack

- **Backend Framework**: Laravel 13 (PHP 8.3+)
- **Admin Panel**: Filament 5.0, Filament Shield
- **Frontend**: Vue.js 3, Inertia.js 3.0
- **Styling**: Tailwind CSS 4, Heroicons
- **Build Tool**: Vite 8
- **Database**: MySQL / MariaDB
- **Caching**: Redis (Optional)

## Installation Guide

### Prerequisites

- PHP 8.3 or higher
- Composer 2.0 or higher
- Node.js 22 or higher
- MySQL 8.0+ or MariaDB 10.6+

### Steps

1. Extract the project archive into your desired directory
2. Install PHP and Node.js dependencies

```bash
composer install
npm install
```

3. Configure the environment variables

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database connection in the `.env` file (see Configuration section)
5. Run database migrations

```bash
php artisan migrate
```

6. Seed initial data (creates default roles, admin user, and sample content)

```bash
php artisan db:seed
```

7. Create storage symlink for media uploads

```bash
php artisan storage:link
```

8. Compile frontend assets

```bash
npm run build
```

9. Start the development server

```bash
php artisan serve
```

The application will be accessible at `http://localhost:8000`.

## Configuration

The application requires environment variables to function correctly. Ensure your `.env` file is properly configured.

### Environment Configuration Customization

#### Application Settings

| Variable | Description | Example |
|----------|-------------|---------|
| `APP_NAME` | The name of the application | `"Knowledge Base"` |
| `APP_ENV` | Current environment state | `local` or `production` |
| `APP_DEBUG` | Enable or disable debug mode | `true` or `false` |
| `APP_URL` | Base application URL | `https://your-domain.com` |
| `APP_LOCALE` | Default application language | `id` |

#### Database Settings

| Variable | Description | Example |
|----------|-------------|---------|
| `DB_CONNECTION` | Database driver | `mysql` |
| `DB_HOST` | Database host | `127.0.0.1` |
| `DB_PORT` | Database port | `3306` |
| `DB_DATABASE` | Database name | `knowledge_base` |
| `DB_USERNAME` | Database user | `root` |
| `DB_PASSWORD` | Database password | `secret` |

#### Redis Settings (Optional)

| Variable | Description | Example |
|----------|-------------|---------|
| `CACHE_STORE` | Cache driver mechanism | `redis` or `file` |
| `REDIS_HOST` | Redis server hostname | `127.0.0.1` |
| `REDIS_PASSWORD` | Redis authentication password | `null` |
| `REDIS_PORT` | Redis server port | `6379` |

#### Mail Settings (Optional)

| Variable | Description | Example |
|----------|-------------|---------|
| `MAIL_MAILER` | Mail driver type | `smtp` |
| `MAIL_HOST` | SMTP server hostname | `smtp.gmail.com` |
| `MAIL_PORT` | SMTP server port | `587` |
| `MAIL_USERNAME` | Authentication username | `email@gmail.com` |
| `MAIL_PASSWORD` | Authentication password | `secret` |
| `MAIL_FROM_ADDRESS` | Default sender address | `noreply@domain.com` |

## Usage

### Accessing the Administration Panel

The administrative dashboard is available at:
`http://your-domain.com/admin`

If you ran the database seeder, you can log in using the default credentials:

- **Email**: `superadmin@gmail.com`
- **Password**: `admin1234`

**Important**: Change the default password immediately after your first login.

### Theme and Branding Customization

**Updating the Logo and Favicon:**
Place your new logo (`logo.svg`) and favicon (`favicon.ico`) directly into the `public/` directory, replacing the existing files. A maximum height of 40px is recommended for optimal display.

**Modifying Admin Panel Colors:**
Navigate to `app/Providers/Filament/AdminPanelProvider.php` and update the color scheme array to match your brand guidelines.

```php
->colors([
    'primary' => Color::Indigo,
    'gray' => Color::Slate,
    'danger' => Color::Rose,
    'info' => Color::Sky,
    'success' => Color::Emerald,
    'warning' => Color::Amber,
])
```

## Production Configuration

When deploying to a production environment, follow these steps to ensure maximum performance and security:

1. **Optimize Application Performance**
Cache the configuration, routing, and views to improve response times:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
```

2. **Secure Environment Variables**
Ensure debug mode is disabled and the application URL is set correctly in `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
```

3. **Compile Production Assets**
Generate optimized, minified frontend assets:

```bash
npm run build
```

4. **Configure Automated Tasks**
Add the Laravel Scheduler to your server's cron tab to handle automated cleanup tasks (e.g., removing unused article images):

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## Project Structure

```text
/
├── app/
│   ├── Console/Commands/         # Custom artisan command definitions
│   ├── Filament/Resources/       # Filament administrative resources and interfaces
│   ├── Http/Controllers/         # Core HTTP request handlers
│   ├── Models/                   # Eloquent ORM models and relationships
│   └── Providers/Filament/       # Administration panel configuration providers
├── config/                       # Application and package configuration files
├── database/
│   ├── migrations/               # Database schema definitions
│   └── seeders/                  # Initial data population scripts
├── lang/id/                      # Indonesian localization and translation files
├── public/                       # Publicly accessible assets and entry point
├── resources/
│   └── js/Pages/                 # Vue components and Inertia.js views
└── storage/app/public/article/   # Secure directory for uploaded article media
```

## Scripts / Commands

| Command | Description |
|---------|-------------|
| `composer dev` | Start the development server including Vite and Laravel queues |
| `composer setup` | Execute initial setup tasks including dependency installation and migrations |
| `composer test` | Run the automated testing suite |
| `./vendor/bin/pint` | Execute Laravel Pint for PHP code formatting |
| `npm run format` | Run Prettier to format frontend source code |
| `php artisan app:clean-unused-article-images` | Trigger the cleanup routine for unreferenced media assets |

## Contributing

Contributions are welcome. To contribute:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/your-feature-name`)
3. Commit your changes (`git commit -m 'Add specific feature'`)
4. Push to the branch (`git push origin feature/your-feature-name`)
5. Open a Pull Request

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for detailed terms and conditions.

## Author

Akselerasi Prima Digital
