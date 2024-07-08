<?php

namespace Ereto\Api\Repositories;

use Ereto\Api\Models\MangaModel;
use Ereto\Connections\Mysql;

class MangaRepository{

  private $table = "users", $sql;
  function __construct() {
    $this->sql = Mysql::conn();
  }

  function createManga(MangaModel $manga) {
    $query = "INSERT INTO ".$this->table."(title) VALUES(:title)";

    $title = $manga->getTitle();

    $stmt = $this->sql->prepare($query);
    $stmt->bindParam(":title", $title);
    $stmt->execute();

    $row = $stmt->fetch();

    if($row) {
      return new MangaModel(null, $title);
    }

    return null;

  }
}
