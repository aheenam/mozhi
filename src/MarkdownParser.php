<?php

namespace Aheenam\Mozhi;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\ExtensionInterface;

class MarkdownParser
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

        $extensions = collect(config('markdown_extensions', []));

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
