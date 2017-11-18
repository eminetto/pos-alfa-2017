<?php

namespace App\Middleware\Format;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Diactoros\Response\HtmlResponse;

class Html implements MiddlewareInterface
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $content = $request->getParsedBody();

        return new HtmlResponse(
            $this->template->render('beer::index', ['content' => $content])
        );
    }
}
