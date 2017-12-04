<?php

namespace OrderSystem\Framework\Routes;

use Slim\App;

class Routes
{
    public function __invoke(App $application): App
    {
        return $application;
    }
}
