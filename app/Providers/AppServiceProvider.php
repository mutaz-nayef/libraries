<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();
// Admin
        Gate::define('admin', function (User $user) {
            return $user->username == 'mutaz';
        });
        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });

// Manager

        Gate::define('manager', function (User $user) {
            return $user->status == 1;
        });

        Blade::if('manager', function () {
            return request()->user()?->can('manager');
        });
    }
}
