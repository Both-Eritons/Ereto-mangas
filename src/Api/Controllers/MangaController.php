<?php

namespace Ereto\Api\Controllers;

use Ereto\Api\Repositories\MangaRepository;
use Ereto\Api\Services\MangaService;
use Ereto\Constants\MangaConstant as MC;
use Ereto\Utils\HttpJson;
use Exception;
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

    try{
      $this->manga->createManga($title);
      return HttpJson::Json(MC::$msg["CREATED"], 200);
    } catch(Exception $e) {
      return HttpJson::Json($e->getMessage(), $e->getCode());
    }
  }

  #[Route("/api/manga/{id}", "GET", "manga.find")]
  function findById(Request $req) {
    $id = $req->only(["id"])["id"];
    $manga = $this->manga->findMangaById($id);

    $arr = [
      "id" => $manga->getId(),
      "title" => $manga->getTitle(),
      "logo" => $manga->getLogo(),
      "author" => $manga->getAuthor()
    ];

    if($manga) {
      return HttpJson::Json(MC::$msg["READ"], 200,  $arr);
    }
    HttpJson::Json(MC::$errors["NOT_FOUND"], 404);
  }
}
