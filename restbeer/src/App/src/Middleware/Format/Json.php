<?php

namespace App\Middleware\Format;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Zend\Diactoros\Response\JsonResponse;

class Json implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $header = $request->getHeader('accept');
        $accept = null;
        if (isset($header[0])) {
            $accept = $header[0];
        }
        if (!$accept || $accept != 'application/json') {
	        return $delegate->process($request);
        }
        $content = $request->getParsedBody();
        return new JsonResponse($content);
    }
}
