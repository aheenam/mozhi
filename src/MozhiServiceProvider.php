<?php

namespace Aheenam\Mozhi;

use Aheenam\Mozhi\Documents\MarkdownDocument\MarkdownParser;
use Illuminate\Support\ServiceProvider;

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
        $this->loadViewsFrom(base_path($this->app['config']['mozhi.theme_path']), 'theme');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MarkdownParser::class, function($app) {
            return new \Aheenam\Mozhi\MarkdownParser();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/mozhi.php', 'mozhi');
    }
}
