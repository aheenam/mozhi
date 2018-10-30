<?php

namespace Aheenam\Mozhi\Documents;

use Aheenam\Mozhi\MarkdownParser;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Page
{
    /**
     * the meta data of the page.
     *
     * @var array
     */
    protected $meta;

    /**
     * the markdown content of the page.
     *
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
     * Page constructor.
     *
     * @param $content
     */
    public function __construct($content)
    {
        $object = YamlFrontMatter::parse($content);
        $this->meta = $object->matter();
        $this->content = $object->body();
        $this->markdownParser = new MarkdownParser();
    }

    /**
     * @param null $key
     *
     * @return array|mixed|null
     */
    public function meta($key = null)
    {
        if ($key === null) {
            return $this->meta;
        }
        if (! isset($this->meta[$key])) {
            return;
        }

        return $this->meta[$key];
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * parses markdown before returning the content.
     *
     * @return string
     */
    public function getParsedContent()
    {
        return $this->markdownParser->parse($this->content);
    }
}
