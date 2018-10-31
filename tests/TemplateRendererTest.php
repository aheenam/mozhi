<?php

namespace Aheenam\Mozhi\Test;

use Aheenam\Mozhi\TemplateRenderer;
use Spatie\Snapshots\MatchesSnapshots;
use Aheenam\Mozhi\Documents\MarkdownDocument;
use Aheenam\Mozhi\Exceptions\TemplateNotFoundException;

class TemplateRendererTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_throws_an_exception_if_view_does_not_exists()
    {
        $this->expectException(TemplateNotFoundException::class);

        $document = MarkdownDocument::fromContent(
            file_get_contents(__DIR__.'/tmp/contents/no-view/no-view.md')
        );

        (new TemplateRenderer($document, 'default'))->render();
    }

    /** @test */
    public function it_renders_a_page_view()
    {
        $document = MarkdownDocument::fromContent(
            file_get_contents(__DIR__.'/tmp/contents/no-template/no-template.md')
        );

        $this->assertMatchesSnapshot((new TemplateRenderer($document, 'default'))->render());
    }

    /** @test */
    public function it_renders_a_view_with_a_table()
    {
        $document = MarkdownDocument::fromContent(
            file_get_contents(__DIR__.'/tmp/contents/table/table.md')
        );

        $this->assertMatchesSnapshot((new TemplateRenderer($document, 'default'))->render());
    }
}
