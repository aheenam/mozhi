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
        $template = $this->page->getTemplateName();

        if (! view()->exists("theme::$currentTheme.$template")) {
            throw new TemplateNotFoundException("Template [$template] was not found in theme [$currentTheme]");
        }

        return view("theme::$currentTheme.$template", collect([
            'meta'    => $this->page->getMetaData(),
            'content' => $this->page->getHtmlContent(),
        ])->concat(collect($data)))->render();
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public static function getCurrentTheme()
    {
        return config('mozhi.theme');
    }
}
