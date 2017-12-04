<?php
/**
 * Created by PhpStorm.
 * User: gareth
 * Date: 28/11/17
 * Time: 14:12
 */

namespace OrderSystem\Framework\Providers;

use Slim\Container;

interface ProviderInterface
{
    public function __invoke(Container $container): Container;
}
