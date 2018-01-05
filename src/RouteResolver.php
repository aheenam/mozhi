<?php

namespace Aheenam\Mozhi;

use Storage;
use Aheenam\Mozhi\Models\Page;

class RouteResolver
{
    /**
     * @param string $route
     *
     * @return null
     */
    public function getPageByRoute($route = null)
    {
        $contentStorage = Storage::disk(config('mozhi.content_disk'));
        $filePath = 'contents/'.$route.'.md';

        if ($route === null || ! $contentStorage->exists($filePath)) {
            return;
        }

        $content = $contentStorage->get($filePath);

        return new Page($content);
    }
}
