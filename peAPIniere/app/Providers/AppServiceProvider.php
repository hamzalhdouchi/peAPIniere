<?php

namespace App\Providers;

use App\Repositories\PlanteRepository;
use App\RepositoryInterface\PlanteRepositoryInterface;
use App\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */ 
    public function register(): void
    {
        $this->app->bind(PlanteRepositoryInterface::class, PlanteRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepositoryInterface::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
