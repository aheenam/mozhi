<?php

namespace Aheenam\Mozhi\Documents\MarkdownDocument;

use League\CommonMark\Environment;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Extension\ExtensionInterface;

class CommonmarkParser implements MarkdownParser
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * @var CommonMarkConverter
     */
    protected $converter;

    public function __construct()
    {
        $this->environment = Environment::createCommonMarkEnvironment();

        $config = [];

        $extensions = collect(config('mozhi.markdown_extensions', []));

        $extensions->each(function ($extension) {
            $this->environment->addExtension($extension);
        });

        $this->converter = new CommonMarkConverter($config, $this->environment);
    }

    public function parse(string $markdown) : string
    {
        return $this->converter->convertToHtml($markdown);
    }

    public function hasExtension(ExtensionInterface $extension) : bool
    {
        return collect($this->environment->getExtensions())->contains($extension);
    }
}
