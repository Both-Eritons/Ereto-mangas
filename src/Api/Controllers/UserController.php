<?php

namespace Ereto\Api\Controllers;

use Ereto\Api\Repositories\UserRepository;
use Ereto\Api\Services\UserService;
use Ereto\Constants\UserConstant as UC;
use Ereto\Utils\HttpJson;
use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class UserController
{

  private $user;
  function __construct()
  {


    $this->user = new UserService(
      new UserRepository()
    );
  }

  function createUser(Request $req, Response $res): Response
  {
    $json = $req->getBody();
    $data = json_decode($json, 1);

    try {
      $this->user->createUser($data["user"], $data["pass"]);
      return HttpJson::Json($res, UC::$msg["CREATED"], 202);
    } catch (Exception $e) {

      return HttpJson::Json($res, $e->getMessage(), $e->getCode());
    }
  }

  function findUser(Request $req, Response $res, array $args): Response
  {
    $id = $args["id"];
    $user = $this->user->UserExist($id);

    if ($user) {

      $arr = [
        "id" => $user->getUserId(),
        "username" => $user->getUsername(),
        "password" => $user->getPassword(),
        "logo" => $user->getLogo()
      ];

      return HttpJson::Json($res, UC::$msg["READ"], 200, $arr);
    }

    return HttpJson::Json($res, UC::$msg["NOT_FOUND"], 404);
  }

  function userProfile(Request $req, Response $res, array $args): Response
  {

    try {
      $user = $this->user->userProfile((int) $args["id"]);

      if ($user) {
        
        $arr = [
        "id" => $user->getUserId(),
        "username" => $user->getUsername(),
        "logo" => $user->getLogo()
      ];

        return HttpJson::Json($res, UC::$msg["READ"], 200, $arr);
      }
    } catch (Exception $e) {
      return HttpJson::Json($res, $e->getMessage(), $e->getCode());
    }
  }
}
