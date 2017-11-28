<?php

use OrderSystem\Framework\SlimFactory;

require '../vendor/autoload.php';

$slimFactory = new SlimFactory();
$slim = $slimFactory();
return $slim->run();
