<?php

namespace Aheenam\Mozhi\Test;

use Aheenam\Mozhi\Models\Page;
use Aheenam\Mozhi\RouteResolver;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class RouteResolverTest extends TestCase
{
    /**
     * @var Filesystem
     */
    private $storage;

    /**
     * @var RouteResolver
     */
    private $routeResolver;

    public function setUp()
    {
        parent::setUp();
        Storage::fake('test_content');
        $this->storage = Storage::disk('test_content');

        $this->routeResolver = new RouteResolver($this->storage);
    }

    /** @test */
    public function it_returns_a_page_by_route()
    {
        $this->storage->put('contents/blog/awesome-blog.md', 'test');
        $page = $this->routeResolver->getPageByRoute('/blog/awesome-blog');

        $this->assertNotNull($page);
        $this->assertInstanceOf(Page::class, $page);
    }

    /** @test */
    public function it_returns_null_if_page_does_not_exists()
    {
        $page = $this->routeResolver->getPageByRoute('/blog/yet-another-awesome-blog');

        $this->assertNull($page);
    }

    /** @test */
    public function it_resolves_routes_only_where_it_was_defined()
    {
        $this->app['router']->group(['prefix' => 'test-prefix'], function () {
            \Mozhi::routes();
        });

        $this->get('/test-prefix')->assertStatus(200);
        $this->get('/')->assertStatus(404);
    }
}
