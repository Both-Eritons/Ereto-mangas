<?php

namespace Ereto\Configs;

use Symfony\Component\Dotenv\Dotenv;


$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__, 2) . '/.env');

class EnvironmentVariables
{
  private static $env;

  private static function initialize(): void
  {
    self::$env = array(
      "STATUS_PROJECT" => $_ENV["STATUS_PROJECT"],

      "DATABASE" => [
        "USER" => $_ENV["DATABASE_USER"],
        "PASSWORD" => $_ENV["DATABASE_PASSWORD"],
        "DATABASE" => $_ENV["DATABASE_NAME"],
        "DATABASE_CON" => "mysql:host=localhost;dbname=" .
          $_ENV["DATABASE_NAME"]
      ],

      "TOKENS" => [
        "JWT_TOKEN" => $_ENV["JWT_TOKEN"]
      ],

      "LOCALS" => [
        "PUBLIC" => $_ENV["SRC_PUBLIC"],
        "PRIVATE" => $_ENV["SRC_PRIVATE"]
      ]
    );
  }

  public static function getEnv(string $key = null) {
    if(!isset(self::$env)) {
      self::initialize();
    }

    if(is_null($key)) {
      return self::$env;
    }

    return self::$env[$key] ?? null;
  }
}
