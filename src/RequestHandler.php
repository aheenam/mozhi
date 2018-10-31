<?php

namespace Aheenam\Mozhi;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RequestHandler extends Controller
{
    public function __invoke(string $slug = '/'): Response
    {
        $contentStorage = Storage::disk(config('mozhi.content_disk'));
        $currentTheme = config('mozhi.theme');
        $page = (new RouteResolver($contentStorage))->getPageByRoute($slug);

        if ($page === null) {
            throw new NotFoundHttpException();
        }
        try {
            $view = (new TemplateRenderer($page, $currentTheme))->render([]);
        } catch (Exceptions\TemplateNotFoundException $e) {
            throw new NotFoundHttpException();
        }

        return response($view, 200);
    }
}
