<?php

namespace Ereto\Connections;

use PDO;
use Ereto\Configs\EnvironmentVariables as Env;

class Mysql {
  static private $sql;

  static function conn(): PDO {
    if(self::$sql == null) {

      self::$sql = new PDO(Env::getEnv("DATABASE")["DATABASE_CON"],
        Env::getEnv("DATABASE")["USER"],
        Env::getEnv("DATABASE")["DATABASE"]["PASSWORD"], [
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
      );

    }

    return self::$sql;
  }
}

