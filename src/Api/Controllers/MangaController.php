<?php

namespace Ereto\Api\Controllers;

use MareaTurbo\Request;
use MareaTurbo\Route;

class MangaController {

  private $manga;
  function __construct() {
    $this->manga = "";
  }

  #[Route("/api/manga/create/{title}", "POST", "manga.create")]
  function createManga(Request $req) {
    $title = $req->only(["title"])["title"];
    echo $title;
  }
}
