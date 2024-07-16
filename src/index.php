<?php
require("../vendor/autoload.php");

use Ereto\Api\Controllers\MangaController;
use Ereto\Api\Controllers\UserController;
use Ereto\Configs\EnvironmentVariables as Env;
use Ereto\Configs\SlimConfiguration;
use Slim\Exception\HttpNotFoundException as HNFE;

use Slim\Factory\AppFactory;

$app = AppFactory::create();
SlimConfiguration::Config($app);

$user = new UserController();
$manga = new MangaController();

$app->get("/user/{id}", function($req, $res, $args) use($user) {
    return $user->findUser($req, $res, $args);
});

$app->post("/user/create", function($req, $res) use($user) {
    return $user->createUser($req, $res);
});

$app->get("/manga/{id}", function($req, $res, $args) use($manga) {
  return $manga->findById($req, $res, $args);
});

$app->run();
