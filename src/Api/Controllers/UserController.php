<?php

namespace Ereto\Api\Controllers;

use Ereto\Api\Repositories\UserRepository;
use Ereto\Api\Services\UserService;
use Ereto\Constants\UserConstant;
use Ereto\Utils\HttpJson;
use Exception;
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

    try{

      $this->user->createUser($user["username"],$user["password"]);
      return HttpJson::Json(UserConstant::$msg["CREATED"], 202);

    } catch(Exception $e) {

      return HttpJson::Json($e->getMessage(), $e->getCode());

    }
  }

  #[Route("/api/user/{id}","GET", "route.findUser")]
  function FindUser(Request $request) {
    $id = $request->only(["id"])["id"];
    $user = $this->user->UserExist($id);

    if($user) {

      $arr = [
        "id" => $user->getUserId(),
        "username" => $user->getUsername(),
        "password" => $user->getPassword(),
        "logo" => $user->getLogo()
      ];

      return HttpJson::Json(UserConstant::$msg["READ"], 200, $arr);
    }

    return HttpJson::Json(UserConstant::$msg["NOT_FOUND"], 404);
  }
}
