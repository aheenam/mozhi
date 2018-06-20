<?php

namespace Aheenam\Mozhi\Test;

use Aheenam\Mozhi\MarkdownParser;

class MarkdownParserTest extends TestCase
{
    /** @test */
    public function it_can_parse_markdown_to_html()
    {
        $parser = new MarkdownParser;

        $this->assertEquals('<h1>Hello World</h1>', trim($parser->parse('# Hello World')));
    }
}
