<?php

namespace Ereto\Api\Controllers;

use Ereto\Api\Repositories\MangaRepository;
use Ereto\Api\Services\MangaService;
use Ereto\Constants\MangaConstant as MC;
use Ereto\Utils\HttpJson;
use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MangaController
{

  private $manga;
  function __construct()
  {
    $this->manga = new MangaService(
      new MangaRepository()
    );
  }

  function createManga(Request $req, Response $res)
  {
    $title = $req->getQueryParams()["title"];

    try {

      $this->manga->createManga($title);
      return HttpJson::Json($res, MC::$msg["CREATED"], 200);
    } catch (Exception $e) {
      return HttpJson::Json($res, $e->getMessage(), $e->getCode());
    }
  }

  function findById(Request $req, Response $res, $args)
  {
    $id = $args["id"];
    $manga = $this->manga->findMangaById($id);

    if ($manga) {
      
      $arr = [
        "id" => $manga->getId(),
        "title" => $manga->getTitle(),
        "logo" => $manga->getLogo(),
        "author" => $manga->getAuthor()
      ];

      return HttpJson::Json($res, MC::$msg["READ"], 200,  $arr);
    }


    return HttpJson::Json($res, MC::$errors["NOT_FOUND"], 404);
  }
}
