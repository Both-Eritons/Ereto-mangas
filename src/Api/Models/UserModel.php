<?php

namespace Ereto\Api\Models;

class UserModel {

  private int $id, $username, $logo, $password;
  function __construct(int $id = null, 
    string $user, 
    string $logo, 
    string $pass) {

    $this->id = $id;
    $this->username = $user;
    $this->logo = $logo;
    $this->password = $pass;

  }

  function getUserId(): int {
    return $this->id;
  }

  function getUsername(): string {
    return $this->username;
  }

  function getLogo(): string {
    return $this->logo;
  }

  function getPassword(): string {
    return $this->password;
  }
}
