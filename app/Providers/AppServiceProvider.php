<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(new User());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
