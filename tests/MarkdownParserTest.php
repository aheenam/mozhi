<?php

namespace Aheenam\Mozhi\Test;

use Aheenam\Mozhi\MarkdownParser;
use Illuminate\Support\Facades\Config;
use Webuni\CommonMark\TableExtension\TableExtension;

class MarkdownParserTest extends TestCase
{
    /** @test */
    public function it_can_parse_markdown_to_html()
    {
        $parser = new MarkdownParser;

        $this->assertEquals('<h1>Hello World</h1>', trim($parser->parse('# Hello World')));
    }

    /** @test */
    public function it_can_add_extensions_from_config()
    {
        Config::set('markdown_extensions', [
            new TableExtension()
        ]);
        $parser = new MarkdownParser;

        $this->assertTrue($parser->hasExtension(new TableExtension));
    }
}
