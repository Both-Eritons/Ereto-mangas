<?php

namespace Ereto\Api\Controllers;

use Ereto\Api\Repositories\UserRepository;
use Ereto\Api\Services\UserService;
use MareaTurbo\Route;
use MareaTurbo\Request;

class UserController{

  private $user;
  function __construct() {


    $this->user = new UserService(
      new UserRepository()
    );


  }

  #[Route("/api/user/register", "POST", "route.createUser")]
  function createUser(Request $request) {
    $json = json_decode(file_get_contents("php://input"));
    print_r($json);
    //$this->user->createUser($json["username"],$json["password"]);
  }

  #[Route("/api/user/{id}","GET", "route.findUser")]
  function FindUser(Request $request) {
    $id = $request->only(["id"])["id"];
     $this->user->UserExist($id); 
  }
}
