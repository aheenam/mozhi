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
    protected $document;

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

    public function __construct(Document $document, string $themeName)
    {
        $this->document = $document;
        $this->themeName = $themeName;
        $this->viewPath = "theme::{$this->themeName}.{$this->document->getTemplateName()}";
    }

    public function render(array $data = []): string
    {
        try {
            return view($this->viewPath, collect([
                'meta' => $this->document->getMetaData(),
                'content' => $this->document->getHtmlContent(),
            ])->concat(collect($data)))->render();
        } catch (\Throwable $e) {
            throw TemplateNotFoundException::forTemplateInTheme($this->document->getTemplateName(), $this->themeName);
        }
    }
}
