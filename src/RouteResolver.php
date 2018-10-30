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

    /**
     * @param string $route
     *
     * @return null
     */
    public function getPageByRoute($route = null)
    {
        $filePath = 'contents/'.$route.'.md';

        if ($route === null) {
            return null;
        }

        try {
            $content = $this->contentStorage->get($filePath);
        } catch (FileNotFoundException $e) {
            return null;
        }

        return new Page($content);
    }
}
