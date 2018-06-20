<?php

namespace Aheenam\Mozhi;

use Aheenam\Mozhi\RouteResolver;
use Illuminate\Routing\Controller;
use Aheenam\Mozhi\TemplateRenderer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RequestHandler extends Controller
{
    /**
     * @param $slug
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke($slug = 'index')
    {
        $page = (new RouteResolver())->getPageByRoute($slug);

        if ($page === null) {
            throw new NotFoundHttpException();
        }
        $view = (new TemplateRenderer($page))->render([]);

        return response($view, 200);
    }
}
