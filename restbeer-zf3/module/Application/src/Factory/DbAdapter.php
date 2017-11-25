<?php

namespace Application\Factory;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter as ZendAdapter;

class DbAdapter
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        return new ZendAdapter($config['db']);
    }
}