<?php

namespace Aheenam\Mozhi\Test;

use Aheenam\Mozhi\RouteResolver;
use Aheenam\Mozhi\TemplateRenderer;
use Spatie\Snapshots\MatchesSnapshots;
use Illuminate\Support\Facades\Storage;
use Aheenam\Mozhi\Exceptions\TemplateNotFoundException;

class TemplateRendererTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_throws_an_exception_if_view_does_not_exists()
    {
        $this->expectException(TemplateNotFoundException::class);

        $page = (new RouteResolver(Storage::disk('content')))
            ->getPageByRoute('/no-view');

        $this->assertMatchesSnapshot((new TemplateRenderer($page, 'default'))->render());
    }

    /** @test */
    public function it_renders_a_page_view()
    {
        $page = (new RouteResolver(Storage::disk('content')))
            ->getPageByRoute('/no-template');

        $this->assertMatchesSnapshot((new TemplateRenderer($page, 'default'))->render());
    }

    /** @test */
    public function it_renders_a_view_with_a_table()
    {
        $page = (new RouteResolver(Storage::disk('content')))
            ->getPageByRoute('/table');

        $this->assertMatchesSnapshot((new TemplateRenderer($page, 'default'))->render());
    }
}
