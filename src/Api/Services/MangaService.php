<?php

namespace Ereto\Api\Services;

use Ereto\Api\Models\MangaModel;
use Ereto\Api\Repositories\MangaRepository;
use Ereto\Constants\MangaConstant as Msg;
use Exception;

class MangaService
{

  private $repo, $arq;
  function __construct(MangaRepository $repo)
  {
    $this->repo = $repo;
  }

  function createManga($title): ?MangaModel
  {
    $mangaFound = $this->findMangaByTitle($title);
    if ($mangaFound) {
      throw new Exception(Msg::$msg["READ"], 409);
    }

    if (strlen($title) < 3) {
      throw new Exception(Msg::$errors["MIN_TITLE"], 400);
    }

    $mangaM = new MangaModel(null, $title);

    $manga = $this->repo->createManga($mangaM);

    return $manga;
  }

  function findMangaById($id): ?MangaModel
  {
    return $this->repo->findManga((int) $id);
  }

  function findMangaByTitle($title): ?MangaModel
  {
    return $this->repo->findMangaByTitle($title);
  }

  function searchManga($title): ?array
  {
    if (is_null($title)) {
      throw new Exception(Msg::$errors["NOT_FOUND"], 404);
    }

    $re = $this->repo->searchManga($title);

    if (is_null($re)) {
      throw new Exception(Msg::$errors["NOT_FOUND"], 404);
    }

    return $re;
  }

  function deleteMangaByTitle($title): ?MangaModel
  {
    if (!$title) {
      throw new Exception(Msg::$errors["BLANK_TITLE"], 400);
    }

    $manga = $this->findMangaByTitle($title);

    if (!$manga) {
      throw new Exception(Msg::$errors["NOT_FOUND"], 404);
    }

    $manga = $this->repo->deleteMangaByTitle($title);

    if (is_null($manga)) {
      throw new Exception(Msg::$errors["DELETE"], 400);
    }

    return $manga;
  }
}
