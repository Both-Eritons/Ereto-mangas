<?php

namespace Ereto\Api\Repositories;

use Ereto\Api\Models\MangaModel;
use Ereto\Connections\Mysql;

class MangaRepository{

  private $table = "mangas", $sql;
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
      return new MangaModel($row["id"], $row["title"], $row["logo"], $row["aurhor"]);
    }

    return null;

  }

  function findManga($id) {
    $query = "SELECT * FROM ".$this->table." WHERE id = :id";
    $stmt = $this->sql->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $row = $stmt->fetch();

    if($row) {
      return new MangaModel($row["id"], $row["title"], $row["logo"], $row["author"]);
    }

    return null;

  }

  function findMangaByTitle($title) {
    $query = "SELECT * FROM ".$this->table." WHERE title = :title";
    $stmt = $this->sql->prepare($query);
    $stmt->bindParam(":title", $title);
    $stmt->execute();

    $row = $stmt->fetch();

    if($row) {
      return new MangaModel($row["id"], $row["title"], $row["logo"], $row["author"]);
    }

    return null;

  }

}
