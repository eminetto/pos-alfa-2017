<?php

namespace App\Factory\Middleware\Format;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use App\Middleware\Format\Html as HtmlMiddleware;

class Html
{
    public function __invoke(ContainerInterface $container)
    {
        return new HtmlMiddleware(
            $container->get(TemplateRendererInterface::class)
        );
    }
}