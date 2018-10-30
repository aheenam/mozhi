<?php

namespace Aheenam\Mozhi;

use Aheenam\Mozhi\Documents\Document;
use Aheenam\Mozhi\Exceptions\TemplateNotFoundException;

class TemplateRenderer
{
    /**
     * the page that the TemplateRenderer should render.
     *
     * @var Document
     */
    protected $page;

    /**
     * The name of the template file that should
     * be used for the page.
     *
     * @var string
     */
    protected $template;

    public function __construct(Document $page)
    {
        $this->page = $page;
    }

    public function render(array $data = []): string
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
