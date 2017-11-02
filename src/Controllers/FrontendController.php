<?php
namespace Aheenam\Mozhi\Controllers;

use Aheenam\Mozhi\RouteResolver;
use Aheenam\Mozhi\TemplateRenderer;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontendController extends Controller
{

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show($slug)
    {
        $page = (new RouteResolver)->getPageByRoute($slug);

        if ($page === null) throw new NotFoundHttpException();

        $view = (new TemplateRenderer($page))->render([]);

        return response($view, 200);
    }

}