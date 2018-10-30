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

    /**
     * @var string
     */
    private $themeName;

    /**
     * @var string
     */
    private $viewPath;

    public function __construct(Document $page, string $themeName)
    {
        $this->page = $page;
        $this->themeName = $themeName;
        $this->viewPath = "theme::{$this->themeName}.{$this->page->getTemplateName()}";
    }

    public function render(array $data = []): string
    {
        try {
            return view($this->viewPath, collect([
                'meta' => $this->page->getMetaData(),
                'content' => $this->page->getHtmlContent(),
            ])->concat(collect($data)))->render();
        } catch (\Throwable $e) {
            throw new TemplateNotFoundException(
                "Template [{$this->page->getTemplateName()}] was not found in theme [$this->themeName]");
        }
    }
}
