<?php

namespace Aheenam\Mozhi\Test;

use Aheenam\Mozhi\Facades\Mozhi;
use Aheenam\Mozhi\MozhiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * add the package provider.
     *
     * @param $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [MozhiServiceProvider::class];
    }

    /**
     * add the package facades.
     */
    protected function getPackageAliases($app)
    {
        return [
            'Mozhi' => Mozhi::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // override the template path
        $app['view']->addNamespace('theme', __DIR__.'/tmp/themes/');

        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('mozhi.content_disk', 'content');
        $app['config']->set('filesystems.disks.content', [
            'driver' => 'local',
            'root'   => __DIR__.'/tmp/',
        ]);

        $app['config']->set('mozhi.markdown_extensions', [
            new \Webuni\CommonMark\TableExtension\TableExtension(),
        ]);
    }
}
