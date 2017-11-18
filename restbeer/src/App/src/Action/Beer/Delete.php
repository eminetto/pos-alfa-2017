<?php

namespace App\Action\Beer;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;

class Delete implements MiddlewareInterface
{
    private $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway   = $tableGateway;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $id = $request->getAttribute('id');
        $beer = $this->tableGateway->select(['id' => $id]);
        if (count($beer) == 0) {
            throw new \Exception("Error Processing Request", 404);
        }

        $this->tableGateway->delete(['id' => $id]);

        return $delegate->process($request)
                        ->withStatus(204);
    }
}