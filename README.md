# Nong Dan So

Nong Dan So is a Laravel application using Inertia, Vue 3, Vite, Tailwind CSS, and Laravel Breeze authentication scaffolding.

## Tech Stack

- PHP 8.3+
- Laravel 13
- MySQL
- Inertia Laravel
- Vue 3
- Vite
- Tailwind CSS
- Laravel Breeze
- Laravel Sanctum

## Requirements

- PHP 8.3 or newer
- Composer
- Node.js and npm
- MySQL or a compatible database

## Setup

Install PHP dependencies:

```bash
composer install
```

Install Node dependencies:

```bash
npm install
```

Create the local environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure database values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nongdanso
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:

```bash
php artisan migrate
```

## Development

Run the Laravel server:

```bash
php artisan serve
```

Run Vite:

```bash
npm run dev
```

Or run the combined development command defined in `composer.json`:

```bash
composer run dev
```

## Build

Build frontend assets:

```bash
npm run build
```

## Tests

Run the test suite:

```bash
php artisan test
```

Run the full Composer test script:

```bash
composer test
```

## Code Style

Format PHP code with Laravel Pint:

```bash
vendor/bin/pint
```

## Project Structure

Important application directories:

- `app/Http/Controllers` - HTTP controllers.
- `app/Models` - Eloquent models.
- `app/Repositories` - Data access layer.
- `app/Services` - Business logic layer.
- `resources/js` - Vue and Inertia frontend code.
- `routes/web.php` - Web routes.
- `routes/auth.php` - Authentication routes from Breeze.
- `database/migrations` - Database schema migrations.

## Repository And Service Pattern

This project uses a lightweight concrete repository/service pattern.

Base classes:

- `app/Repositories/BaseRepository.php`
- `app/Services/BaseService.php`

Example implementation:

- `app/Repositories/UserRepository.php`
- `app/Services/UserService.php`
- `app/Http/Controllers/UserController.php`

Controllers should call services instead of accessing repositories directly. Services handle business logic, while repositories handle Eloquent queries.

Example:

```php
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService) {}

    public function index()
    {
        return response()->json($this->userService->paginate());
    }
}
```

## Notes

- Do not commit `.env`.
- Keep module-specific business rules inside services.
- Add repository methods only when the query is reused or meaningfully complex.
- Prefer Laravel validation form requests for larger create/update flows.
