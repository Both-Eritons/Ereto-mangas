<?php
require("../vendor/autoload.php");

use Slim\Factory\AppFactory;
use Ereto\Configs\SlimConfiguration;
use Ereto\Routes\Routes;


$app = AppFactory::create();
SlimConfiguration::Config($app);
$routes = new Routes();
$routes->run($app);
