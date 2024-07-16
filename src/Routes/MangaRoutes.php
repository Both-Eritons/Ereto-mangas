<?php

namespace Ereto\Routes;

use Ereto\Api\Controllers\MangaController;

class MangaRoutes
{
  private $manga;
  function __construct() {
    $this->manga = new MangaController();
  }

  function mangaRoutes($app)
  {
    $app->get("/manga/{id}", function ($req, $res, $args) {
      return $this->manga->findById($req, $res, $args);
    });
  }
}
