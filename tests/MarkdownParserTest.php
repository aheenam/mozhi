<?php

namespace Aheenam\Mozhi\Test;


use Aheenam\Mozhi\Documents\MarkdownDocument\CommonmarkParser;
use Illuminate\Support\Facades\Config;
use Webuni\CommonMark\TableExtension\TableExtension;

class MarkdownParserTest extends TestCase
{
    /** @test */
    public function it_can_parse_markdown_to_html()
    {
        $parser = new CommonmarkParser;

        $this->assertEquals('<h1>Hello World</h1>', trim($parser->parse('# Hello World')));
    }

    /** @test */
    public function it_can_add_extensions_from_config()
    {
        Config::set('markdown_extensions', [
            new TableExtension(),
        ]);
        $parser = new CommonmarkParser;

        $this->assertTrue($parser->hasExtension(new TableExtension));
    }
}
