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

  #[Route("/api/user/register/{user}/{pass}", "POST", "route.createUser")]
  function createUser(Request $request) {
    $user = array(
      "username" => $request->only(["user"])["user"],
      "password" => $request->only(["pass"])["pass"]
    );
    
    $this->user->createUser($user["username"],$user["password"]);
  }

  #[Route("/api/user/{id}","GET", "route.findUser")]
  function FindUser(Request $request) {
    $id = $request->only(["id"])["id"];
     $this->user->UserExist($id); 
  }
}
