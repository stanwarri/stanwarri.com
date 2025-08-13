# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Standard Workflow

1. First think through the problem, read the codebase for relevant files, and write a plan to projectplan.md
2. The plan should have a list of todo items that you can check off as you complete them
3. Begin you begin, check in with me on your plan, and I will verify the plan
4. Then begin working on the todo items, marking them as complete as you go
5. Read through my code patterns when writing new classes or code. You can check the prompts folder for more details
5. Please every step of the way, just give me a high level explanation of what changes you made
6. Make every task and code change you do as simple (small) as possible. We want to avoid making any massive or complex changes
7. After successfully implementing any feature, bug fix, or improvement, update the product-updates.md file with the changes made
8. Finally, add a review section to the projectplan.md file with a summary of the changes you made and any other relevant information

## Project Overview

This is a Laravel 12 application with FilamentPHP admin panel for building a personal community website. The stack includes:

- **Backend**: Laravel 12 with PHP 8.2+
- **Admin Panel**: FilamentPHP 4.0 for administration interface at `/admin`
- **Frontend**: Vite with TailwindCSS 4.0 for asset compilation
- **Database**: SQLite (default), configurable
- **Testing**: PHPUnit with Feature and Unit test directories

## Development Commands

### Core Development
```bash
# Start development server with queue, logs, and asset watching
composer run dev

# Alternative: Start individual services
php artisan serve                # Development server
php artisan queue:listen --tries=1  # Queue worker
php artisan pail --timeout=0    # Log viewer
npm run dev                      # Vite asset watching
```

### Testing
```bash
# Run all tests
composer run test
# Or manually:
php artisan test

# Run specific test suites
php artisan test --testsuite=Unit
php artisan test --testsuite=Feature
```

### Asset Management
```bash
npm run dev      # Development with hot reloading
npm run build    # Production build
```

### Code Quality
```bash
# Laravel Pint for code formatting
./vendor/bin/pint

# Clear caches when needed
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## Architecture

### FilamentPHP Admin Panel
- Located at `/admin` route
- Configuration: `app/Providers/Filament/AdminPanelProvider.php`
- Auto-discovers resources in `app/Filament/Resources/`
- Auto-discovers pages in `app/Filament/Pages/`
- Auto-discovers widgets in `app/Filament/Widgets/`
- Uses Amber color scheme as primary color

### Service Providers
Registered in `bootstrap/providers.php`:
- `AppServiceProvider` - Main application services
- `AdminPanelProvider` - FilamentPHP panel configuration

### Database
- Default: SQLite with file at `database/database.sqlite`
- Migrations in `database/migrations/`
- Uses standard Laravel authentication with users table

### Frontend Assets
- Entry points: `resources/css/app.css`, `resources/js/app.js`  
- TailwindCSS 4.0 with Vite integration
- Configuration: `vite.config.js`

## Key Files to Understand

- `app/Providers/Filament/AdminPanelProvider.php` - FilamentPHP configuration
- `bootstrap/providers.php` - Service provider registration
- `composer.json` - Defines dev workflow scripts and dependencies
- `routes/web.php` - Web routes (currently minimal)
