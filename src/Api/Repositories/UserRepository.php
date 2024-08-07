<?php

namespace Ereto\Api\Repositories;

use Ereto\Api\Models\UserModel;
use Ereto\Connections\Mysql;

class UserRepository{
  private $table = "users";
  private $sql;

  public function __construct() {
    $this->sql = Mysql::conn();
  }

  function createUser(UserModel $user) {

    $query = "INSERT INTO ".$this->table."(username, password) VALUES(:username, :password)";

    $username = $user->getUsername();
    $password = $user->getPassword();

    $stmt = $this->sql->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $row = $stmt->fetch();

    if($row) {
      return new UserModel($row["id"], $row["username"], $row["logo"], $row["password"]);
    }

    return null;
  }

  function findUser(int $id) {
    $query = "SELECT * FROM ".$this->table." WHERE id = :id";
    $stmt = $this->sql->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $row = $stmt->fetch();
    
    if($row) {

      return new UserModel($row["id"], $row["username"], $row["logo"], $row["password"]);

    }

    return null;
  }
  function findUserByUsername($username) {
    $query = "SELECT * FROM ".$this->table." WHERE username = :username";
    $stmt = $this->sql->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $row = $stmt->fetch();
    
    if($row) {

      return new UserModel($row["id"], $row["username"], $row["logo"], $row["password"]);

    }

    return null;
  }

}
