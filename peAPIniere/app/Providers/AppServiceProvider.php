<?php

namespace App\Providers;

use App\Models\Commande;
use App\Policies\OrderPolicy;
use App\Repositories\CategoryRepository;
use App\repository\CommandeRepository;
use App\RepositoryInterface\CategoryRepositoryInterface;
use \App\repository\PlanteRepository;
use App\repository\UserRepository;
use App\RepositoryInterface\CommandeRepositoryInterface;
use App\RepositoryInterface\PlanteRepositoryInterface;
use App\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */ 
    protected $policies = [
        Commande::class => OrderPolicy::class,
    ];
    public function register(): void
    {
        $this->app->bind(PlanteRepositoryInterface::class, PlanteRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CommandeRepositoryInterface::class, CommandeRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
