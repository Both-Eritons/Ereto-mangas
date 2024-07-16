<?php

namespace Ereto\Configs;

use Ereto\Configs\EnvironmentVariables as Env;
use Slim\Exception\HttpNotFoundException as HNFE;

class SlimConfiguration
{

  static function Config($app)
  {
    $errMid = $app->addErrorMiddleware(true, true, true);

    if (Env::getEnv("STATUS_PROJECT") == "prod") {
      $errMid = $app->addErrorMiddleware(false, true, true);
    }

    $errMid->setErrorHandler(HNFE::class, function () use ($app) {
      $res = $app->getResponseFactory()->createResponse();
      $res->getBody()->write(json_encode([
        "error" => "page not found"
      ], JSON_PRETTY_PRINT));
      return $res->withStatus(404);
    });

  }
}
