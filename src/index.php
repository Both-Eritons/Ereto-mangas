<?php
require("../vendor/autoload.php");

use Ereto\Api\Controllers\MangaController;
use Ereto\Api\Controllers\UserController;
use Ereto\Configs\EnvironmentVariables as Env;
use Slim\Exception\HttpNotFoundException as HNFE;

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$errMid = $app->addErrorMiddleware(true , true, true);

if(Env::getEnv("STATUS_PROJECT") == "prod") {
  $errMid = $app->addErrorMiddleware(false, true, true);
}
$errMid->setErrorHandler(HNFE::class, function () use ($app) {
    $res = $app->getResponseFactory()->createResponse();
    $res->getBody()->write(json_encode([
      "error" => "page not found"
    ], JSON_PRETTY_PRINT));
    return $res->withStatus(404);
});

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
