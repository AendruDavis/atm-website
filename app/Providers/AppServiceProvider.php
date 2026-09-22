<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::preventLazyLoading(! $this->app->isProduction());

        View::composer('layouts.app', function ($view): void {
            $view->with('siteSettings', SiteSetting::query()->first());
        });
    }
}
