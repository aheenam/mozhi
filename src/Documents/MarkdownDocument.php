<?php

namespace Aheenam\Mozhi\Documents;

use Aheenam\Mozhi\MarkdownParser;
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

    public function __construct(string $content, array $metaData, string $templateName)
    {
        $this->content = $content;
        $this->metaData = $metaData;
        $this->templateName = $templateName;
        $this->markdownParser = new MarkdownParser();
    }

    public static function fromContent(string $content): self
    {
        $content = YamlFrontMatter::parse($content);
        $templateName = $content->matter('template', config('mozhi.default_template'));

        return new self($content->body(), $content->matter(), $templateName);
    }

    public function getRawContent(): string
    {
        return $this->content;
    }

    /**
     * parses markdown before returning the content.
     *
     * @return string
     */
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
