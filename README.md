# Project Setup Instructions

Follow these steps to set up the project:

1. **Create `.env` File**:
   - Copy the contents of `env.example` to a new file named `.env`.

2. **Install Dependencies**:
   - Run the following command to install all necessary dependencies:
     ```bash
     composer install
     ```

3. **Generate Application Key**:
   - Run the following command to generate a new application key:
     ```bash
     php artisan key:generate
     ```

4. **Run Migrations and Seed Database**:
   - Run the following command to migrate the database and seed it with initial data:
     ```bash
     php artisan migrate --seed
     ```

5. **Check CSRF Token Validation**:
   - Ensure your domain is listed in the `validateCsrfTokens` method in `bootstrap/app.php`. If not, add it:
     ```php
     use Illuminate\Foundation\Application;
     use Illuminate\Foundation\Configuration\Middleware;

    return Application::configure(basePath: dirname(__DIR__))
        ->withRouting(
            web: __DIR__.'/../routes/web.php',
            api: __DIR__.'/../routes/api.php',
            commands: __DIR__.'/../routes/console.php',
            health: '/up',
        )
        ->withMiddleware(function (Middleware $middleware) {
            $middleware->append(StartSession::class);
            $middleware->append(VerifyCsrfToken::class);
            $middleware->validateCsrfTokens(except: [
                'http://127.0.0.1:8000/*', // <-- add your route here
                'http://localhost:8000/*',
            ]);
        })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
     ```

That's it! Your project should now be set up and ready to use.
