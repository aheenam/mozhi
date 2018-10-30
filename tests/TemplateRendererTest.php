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
    public function it_returns_current_theme()
    {
        $theme = TemplateRenderer::getCurrentTheme();

        $this->assertEquals('default', $theme);
    }

    /** @test */
    public function it_uses_the_correct_template_of_a_page()
    {
        $page = (new RouteResolver(Storage::disk('content')))
            ->getPageByRoute('/blog/awesome-blog');

        $template = (new TemplateRenderer($page))->getTemplate();

        $this->assertEquals('blog', $template);
    }

    /** @test */
    public function it_returns_default_if_no_template_is_defined()
    {
        $page = (new RouteResolver(Storage::disk('content')))
            ->getPageByRoute('/no-template');

        $template = (new TemplateRenderer($page))->getTemplate();

        $this->assertEquals('page', $template);
    }

    /** @test */
    public function it_throws_an_exception_if_view_does_not_exists()
    {
        $this->expectException(TemplateNotFoundException::class);

        $page = (new RouteResolver(Storage::disk('content')))
            ->getPageByRoute('/no-view');

        $this->assertMatchesSnapshot((new TemplateRenderer($page))->render());
    }

    /** @test */
    public function it_renders_a_page_view()
    {
        $page = (new RouteResolver(Storage::disk('content')))
            ->getPageByRoute('/no-template');

        $this->assertMatchesSnapshot((new TemplateRenderer($page))->render());
    }

    /** @test */
    public function it_renders_a_view_with_a_table()
    {
        $page = (new RouteResolver(Storage::disk('content')))
            ->getPageByRoute('/table');

        $this->assertMatchesSnapshot((new TemplateRenderer($page))->render());
    }
}
