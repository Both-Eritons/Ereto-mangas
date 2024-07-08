<?php

namespace Ereto\Api\Models;

class MangaModel {

  private $id, $title, $logo, $author;
  function __construct($id = null, $title, $logo = null, $author = null) {
    $this->id = $id;
    $this->title = $title;
    $this->logo = $logo;
    $this->author = $author;
  }

  function getId() {
    return $this->id;
  }

  function getTitle() {
    return $this->title;
  }

  function getLogo() {
    return $this->logo;
  }

  function getAuthor() {
    return $this->author;
  }
}
