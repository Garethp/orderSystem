<?php

namespace OrderSystem\Framework;

use Slim\App;
use Slim\Container;

class SlimFactory
{
    public function __invoke(): App
    {
        $container = new Container();
        $container = (new Providers\Providers())($container);

        $app = new App($container);
        return (new Routes\Routes())($app);
    }
}
