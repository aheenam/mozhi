<?php
namespace Aheenam\Mozhi\Test;

use Aheenam\Mozhi\Exceptions\TemplateNotFoundException;
use Aheenam\Mozhi\RouteResolver;
use Aheenam\Mozhi\TemplateRenderer;
use Spatie\Snapshots\MatchesSnapshots;

class TemplateRendererTest extends TestCase
{

    use MatchesSnapshots;

    /** @test */
    public function it_returns_current_theme ()
    {
        $theme = TemplateRenderer::getCurrentTheme();

        $this->assertEquals('default', $theme);
    }

    /** @test */
    public function it_uses_the_correct_template_of_a_page ()
    {
        $page = (new RouteResolver)->getPageByRoute('/blog/awesome-blog');

        $template = (new TemplateRenderer($page))->getTemplate();

        $this->assertEquals('blog', $template);
    }

    /** @test */
    public function it_returns_default_if_no_template_is_defined ()
    {
        $page = (new RouteResolver)->getPageByRoute('/no-template');

        $template = (new TemplateRenderer($page))->getTemplate();

        $this->assertEquals('page', $template);
    }

    /** @test */
    public function it_throws_an_exception_if_view_does_not_exists()
    {
        $this->expectException(TemplateNotFoundException::class);

        $page = (new RouteResolver)->getPageByRoute('/no-view');

        $this->assertMatchesSnapshot((new TemplateRenderer($page))->render());
    }

    /** @test */
    public function it_renders_a_page_view ()
    {
        $page = (new RouteResolver)->getPageByRoute('/no-template');

        $this->assertMatchesSnapshot((new TemplateRenderer($page))->render());
    }

}