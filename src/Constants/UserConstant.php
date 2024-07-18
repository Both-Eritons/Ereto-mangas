<?php

namespace Ereto\Constants;

final class UserConstant
{
  static $msg = [
    "CREATED" => "User Created",
    "READ" => "User Found",
    "UPDATE" => "User Updated",
    "DELETED" => "User Deleted",
  ];
  static $errors = [
    "NOT_FOUND" => "User Not Found",
    "BODY" => "Body is Wrong",
    "EXISTS" => "Username already exists",
    "MIN_USER" => "Username is small",
    "USERNAME_BETWEEN" => "user needs to be between 4-10",
    "PASSWORD_BETWEEN" => "password needs to be between 6-24",
  ];
}
