<?php

namespace Ereto\Routes;

class Routes {

  private $user, $manga;
  function __construct() {
    $this->user = new UserRoutes();
    $this->manga = new MangaRoutes();
  }

  private function routes($app) {
    $this->user->userRoutes($app);
    $this->manga->mangaRoutes($app);
  }

  function run($app) {
    $this->routes($app);
    return $app->run();
  }

}
