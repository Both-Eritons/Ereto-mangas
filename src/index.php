<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
require("vendor/autoload.php");

use Ereto\Api\Controllers\MangaController;
use MareaTurbo\Router;
use Ereto\Api\Controllers\UserController;

(new Router())->controllers([
  UserController::class,
  MangaController::class
]);
