<?php

require("vendor/autoload.php");

use MareaTurbo\Router;
use Ereto\Api\Controllers\UserController;

(new Router())->controllers([
  UserController::class
]);
