<?php

namespace App\Factory\Action;

use Interop\Container\ContainerInterface;
use Zend\Db\TableGateway\TableGateway;

class Beer
{
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $adapter = $container->get('App\Factory\Db\Adapter\Adapter');
        $tableGateway = new TableGateway('beer', $adapter);

        return new $requestedName($tableGateway);
    }
}
