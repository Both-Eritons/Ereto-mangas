<?php

namespace Ereto\Constants;

class MangaConstant
{
  static $msg = [
    "CREATED" => "Manga Created",
    "READ" => "Manga Found",
    "UPDATE" => "Manga Updated",
    "DELETE" => "Manga Deleted",
  ];
  static $errors = [
    "NOT_FOUND" => "Manga Not Found",
    "BLANK_TITLE" => "The Title cannot be blank",
    "MIN_TITLE" => "The Title is small",
    "EXISTS" => "Manga already exists",
    "DELETE" => "Unable to delete the manga"
  ];
}
