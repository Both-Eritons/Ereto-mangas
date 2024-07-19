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
    
    $app->post("/manga/create", function ($req, $res) {
      return $this->manga->createManga($req, $res);
    });

    $app->get("/manga/{id}", function ($req, $res, $args) {
      return $this->manga->findById($req, $res, $args);
    });

    $app->get("/search", function ($req, $res, $args) {
      return $this->manga->searchManga($req, $res, $args);
    });

    //$app->get("/manga/delete/{id}", function ($req, $res, $args) {});
  }
}
