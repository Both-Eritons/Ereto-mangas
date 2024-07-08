<?php

namespace Ereto\Api\Controllers;

use Ereto\Api\Repositories\MangaRepository;
use Ereto\Api\Services\MangaService;
use MareaTurbo\Request;
use MareaTurbo\Route;

class MangaController {

  private $manga;
  function __construct() {
    $this->manga = new MangaService(
      new MangaRepository()
    );
  }

  #[Route("/api/manga/create/{title}", "POST", "manga.create")]
  function createManga(Request $req) {
    $title = $req->only(["title"])["title"];
    echo $title;
  }
}
