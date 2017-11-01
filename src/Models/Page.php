<?php
namespace Aheenam\Mozhi\Models;


use League\CommonMark\CommonMarkConverter;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Page
{
    /**
     * the meta data of the page
     *
     * @var array
     */
    protected $meta;

    /**
     * the markdown content of the page
     *
     * @var string
     */
    protected $content;

    /**
     * The markdown parser
     *
     * @var CommonMarkConverter
     */
    protected $converter;

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
        $this->converter = new CommonMarkConverter;
    }

    /**
     * @param null $key
     * @return array|mixed|null
     */
    public function meta($key = null)
    {
        if ($key === null) return $this->meta;
        if (!isset($this->meta[$key])) return null;
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
     * parses markdown before returning the content
     *
     * @return string
     */
    public function getParsedContent()
    {
        return $this->converter->convertToHtml($this->content);
    }

}