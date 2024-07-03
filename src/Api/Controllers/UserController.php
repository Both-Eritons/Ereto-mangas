<?php

namespace Ereto\Api\Controllers;

use Ereto\FileManagements\MangaManagement;
use MareaTurbo\Route;
use Ereto\Configs\EnvironmentVariables as Vars;

class UserController{

  #[Route("/test","GET", "route.name")]
  function test($request) {
    //$mangaM = new MangaManagement("_cdn/public");
  }
}
