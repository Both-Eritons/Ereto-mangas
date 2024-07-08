<?php

namespace Ereto\Api\Services;

use Ereto\Api\Models\MangaModel;
use Ereto\Api\Repositories\MangaRepository;
use Ereto\Constants\MangaConstant as Msg;
use Exception;

class MangaService {

  private $repo;
  function __construct(MangaRepository $repo) {
    $this->repo = $repo;
  }

  function createManga($title): ?MangaModel {
    $mangaFound = $this->findMangaByTitle($title);

    if($mangaFound) {
      throw new Exception(Msg::$msg["READ"], 400);      
    }

    if(strlen($title) < 3) {
      throw new Exception(Msg::$errors["MIN_TITLE"], 400);
    }

    $mangaM = new MangaModel(null, $title);
    return $this->repo->createManga($mangaM);
  }

  function findMangaById($id): ? MangaModel {
    return $this->repo->findManga($id);
  }

  function findMangaByTitle($title): ? MangaModel {
    return $this->repo->findMangaByTitle($title);
  }

}
