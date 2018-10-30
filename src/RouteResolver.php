<?php

namespace Aheenam\Mozhi;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Filesystem\Filesystem;
use Storage;
use Aheenam\Mozhi\Models\Page;

class RouteResolver
{
    /**
     * @var Filesystem
     */
    private $contentStorage;

    public function __construct(Filesystem $contentStorage)
    {
        $this->contentStorage = $contentStorage;
    }

    public function getPageByRoute(string $route): ?Page
    {
        $filePath = $this->getFilePath($route);

        try {
            $content = $this->contentStorage->get($filePath);
        } catch (FileNotFoundException $e) {
            return null;
        }

        return new Page($content);
    }

    private function getFilePath(string $route): string
    {
        if ($route === '/') {
            return 'contents/index.md';
        }
        $fileName = collect(explode('/', $route))->pop() . '.md';

        return 'contents/' . $route . '/' . $fileName;
    }
}
