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

  #[Route("/user/{id}","GET", "route.name")]
  function FindUser(Request $request) {
    $id = $request->only(["id"])["id"];
     $this->user->UserExist($id); 
  }
}
