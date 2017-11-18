<?php

namespace App\Action\Beer;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;

class Index implements MiddlewareInterface
{
    private $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway   = $tableGateway;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $beers = $this->tableGateway->select()->toArray();
        return $delegate->process(
            $request->withParsedBody($beers)
        );
    }
}
