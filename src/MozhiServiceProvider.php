<?php

namespace Aheenam\Mozhi;

use Illuminate\Support\ServiceProvider;
use League\CommonMark\CommonMarkConverter;

class MozhiServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // publish config files
        $this->publishes([
            __DIR__.'/../config/mozhi.php' => config_path('mozhi.php'),
        ]);

        // set the themes views
        $this->loadViewsFrom(config('theme_path'), 'theme');

        // load the routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/mozhi.php', 'mozhi');
    }
}