<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Stripe\Stripe;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Tambahkan directive currency di sini
        Blade::directive('currency', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', '.'). 'USD'; ?>";
        });
    }
}
