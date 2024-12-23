<?php

namespace App\Providers;

use App\Models\UsersResponseForm1;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(255);
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(255);

        //convocatoria
         
        if (auth()->check()) {
            $convocatoria = UsersResponseForm1::where('user_id', auth()->id())->latest()->first();
            if ($convocatoria) {
                view()->share('convocatoria', $convocatoria->convocatoria);
            }
        }
    }
}
