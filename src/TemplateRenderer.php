<?php

namespace Aheenam\Mozhi;

use Aheenam\Mozhi\Documents\MarkdownDocument;
use Aheenam\Mozhi\Exceptions\TemplateNotFoundException;

class TemplateRenderer
{
    /**
     * the page that the TemplateRenderer should render.
     *
     * @var MarkdownDocument
     */
    protected $page;

    /**
     * The name of the template file that should
     * be used for the page.
     *
     * @var string
     */
    protected $template;

    /**
     * TemplateRenderer constructor.
     *
     * @param MarkdownDocument $page
     */
    public function __construct(MarkdownDocument $page)
    {
        $this->page = $page;
    }

    /**
     * returns a rendered string.
     *
     * @param array $data
     *
     * @throws TemplateNotFoundException
     *
     * @return string
     */
    public function render($data = [])
    {
        $currentTheme = self::getCurrentTheme();
        $template = $this->getTemplate();

        if (! view()->exists("theme::$currentTheme.$template")) {
            throw new TemplateNotFoundException("Template [$template] was not found in theme [$currentTheme]");
        }

        return view("theme::$currentTheme.$template", collect([
            'meta'    => $this->page->meta(),
            'content' => $this->page->getParsedContent(),
        ])->concat(collect($data)))->render();
    }

    /**
     * @return array|\Illuminate\Config\Repository|mixed|null|string
     */
    public function getTemplate()
    {
        if ($this->template === null) {
            $this->template = $this->resolveTemplate();
        }

        return $this->template;
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public static function getCurrentTheme()
    {
        return config('mozhi.theme');
    }

    /**
     * returns the template of the page
     * defaults to default_template of config if none set.
     *
     * @return array|\Illuminate\Config\Repository|mixed|null
     */
    protected function resolveTemplate()
    {
        if ($this->page->meta('template') === null) {
            return config('mozhi.default_template');
        }

        return $this->page->meta('template');
    }
}
