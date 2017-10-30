<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
             'App\Models\Contracts\Repositories\CurrentYearRepository', // Repository (Interface)
             'App\Models\Concrete\Eloquent\EloquentCurrentYearRepository' // Eloquent (Class)
        );
        
        $this->app->bind(
             'App\Models\Contracts\Repositories\HistoryRepository', // Repository (Interface)
             'App\Models\Concrete\Eloquent\EloquentHistoryRepository' // Eloquent (Class)
        );
        
        $this->app->bind(
             'App\Models\Contracts\Repositories\UserRepository', // Repository (Interface)
             'App\Models\Concrete\Eloquent\EloquentUserRepository' // Eloquent (Class)
        );
        
        $this->app->bind(
             'App\Models\Contracts\Repositories\SubscriptionRepository', // Repository (Interface)
             'App\Models\Concrete\Eloquent\EloquentSubscriptionRepository' // Eloquent (Class)
        );
        
        $this->app->bind(
             'App\Models\Contracts\Repositories\SubscriptionRepository', // Repository (Interface)
             'App\Models\Concrete\Eloquent\EloquentSubscriptionRepository' // Eloquent (Class)
        );
        
        //
    }
}
