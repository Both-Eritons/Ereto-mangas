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

    $query = "INSERT INTO".$this->table."(username, password) VALUES(:username, :password)";

    

    $stmt = $this->sql->prepare($query);
    $stmt->bindParam(":username", $user->getUsername());
    $stmt->bindParam(":password", $user->getPassword());
    $stmt->execute();

    $row = $stmt->fetch();

    if($row) {
      return new UserModel($row["id"], $row["username"], $row["logo"], $row["password"]);
    }

    return null;
  }

  function findUser($id) {
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
}
