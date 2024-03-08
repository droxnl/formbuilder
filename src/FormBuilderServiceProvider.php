<?php

declare(strict_types=1);

namespace Droxnl\FormBuilder;

use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/formbuilder.php' => config_path('formbuilder.php'),
        ]);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('formbuilder', function($app){
            return new FormBuilder($app['config']['formbuilder']['style']);
        });
    }
}