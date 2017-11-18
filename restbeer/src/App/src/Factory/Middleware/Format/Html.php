<?php

namespace App\Factory\Middleware\Format;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use App\Middleware\Format\Html as HtmlMiddleware;
use Zend\Expressive\ZendView\ZendViewRenderer;

class Html
{
    public function __invoke(ContainerInterface $container)
    {
        $renderer = new ZendViewRenderer();
        // print_r($renderer);
        // exit;
        return new HtmlMiddleware(
            // $container->get(TemplateRendererInterface::class)
            $renderer
        );
    }
}