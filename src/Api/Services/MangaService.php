<?php

namespace Ereto\Api\Services;

use Ereto\Api\Repositories\MangaRepository;

class MangaService {

  private $repo;
  function __construct(MangaRepository $repo) {
    $this->repo = $repo;
  }

  function createManga($title) {

  }
}
