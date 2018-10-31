<?php

namespace Aheenam\Mozhi\Documents\MarkdownDocument;

use Aheenam\Mozhi\Documents\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class MarkdownDocument implements Document
{
    /**
     * @var string
     */
    protected $content;

    /**
     * The markdown parser.
     *
     * @var MarkdownParser
     */
    protected $markdownParser;
    /**
     * @var array
     */
    private $metaData;
    /**
     * @var string
     */
    private $templateName;

    public function __construct(
        string $content,
        array $metaData,
        string $templateName,
        MarkdownParser $markdownParser
    ) {
        $this->content = $content;
        $this->metaData = $metaData;
        $this->templateName = $templateName;
        $this->markdownParser = $markdownParser;
    }

    public static function fromContent(string $content): self
    {
        $content = YamlFrontMatter::parse($content);
        $templateName = $content->matter('template', config('mozhi.default_template'));

        return new self(
            $content->body(),
            $content->matter(),
            $templateName,
            app()->get(MarkdownParser::class)
        );
    }

    public function getRawContent(): string
    {
        return $this->content;
    }

    public function getHtmlContent(): string
    {
        return $this->markdownParser->parse($this->content);
    }

    public function getMetaData(): array
    {
        return $this->metaData;
    }

    public function getTemplateName(): string
    {
        return $this->templateName;
    }
}
