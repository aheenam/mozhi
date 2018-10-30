<?php

namespace Aheenam\Mozhi\Test\Documents;

use Aheenam\Mozhi\Documents\MarkdownDocument;
use Aheenam\Mozhi\Test\TestCase;
use Illuminate\Support\Facades\Config;

class MarkdownDocumentTest extends TestCase
{
    /** @test */
    public function it_creates_document_from_content()
    {
        Config::set('mozhi.default_template', 'default');
        $content = file_get_contents(__DIR__ . '/../tmp/contents/index.md');
        $document = MarkdownDocument::fromContent($content);

        $this->assertInstanceOf(MarkdownDocument::class, $document);
        $this->assertEquals(['title' => 'Index'], $document->getMetaData());
        $this->assertEquals('default', $document->getTemplateName());
    }
}