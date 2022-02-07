<?php

namespace App\Providers;

use App\Models\Type;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['templates.header', 'templates.footer'], function ($view){
            $view->with('typesHeader', Type::all());
        });
    }
}
