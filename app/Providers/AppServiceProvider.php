<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Compra;

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
        View::composer('*', function($view) {
            $carritoCount = 0;

            if(Auth::check()) {
                $carritoCount = Compra::where('usuario_id', Auth::id())->sum('cantidad');
            }

            $view->with('carritoCount', $carritoCount);
        });
    }
}
