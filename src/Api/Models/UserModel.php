<?php

namespace Ereto\Api\Models;

class UserModel {

  private $id, $username, $logo, $password;
  function __construct($id = null, $user, $logo, $pass) {

    $this->id = $id;
    $this->username = $user;
    $this->logo = $logo;
    $this->password = $pass;

  }

  function getUserId() {
    return $this->id;
  }

  function getUsername() {
    return $this->username;
  }

  function getLogo() {
    return $this->logo;
  }

  function getPassword() {
    return $this->password;
  }
}
