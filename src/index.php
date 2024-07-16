<?php
require("../vendor/autoload.php");

use Ereto\Api\Controllers\MangaController;
use Ereto\Configs\SlimConfiguration;
use Ereto\Routes\Routes;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
SlimConfiguration::Config($app);

$manga = new MangaController();

$routes = new Routes();
$routes->run($app);


