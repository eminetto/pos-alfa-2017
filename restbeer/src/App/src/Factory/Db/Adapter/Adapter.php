<?php

namespace App\Factory\Db\Adapter;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter as ZendAdapter;

class Adapter
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        return new ZendAdapter($config['db']);
    }
}
