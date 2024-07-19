<?php

namespace Ereto\Routes;

use Ereto\Api\Controllers\UserController;

class UserRoutes
{
  private $user;
  function __construct(){
    $this->user = new UserController();
  }

  function userRoutes($app)
  {
    $app->get("/user/{id}", function ($req, $res, $args) {
      return $this->user->findUser($req, $res, $args);
    });

    $app->post("/user/create", function ($req, $res) {
      return $this->user->createUser($req, $res);
    });

    $app->get("/user/profile/{id}", function($req, $res, $args) {
      return $this->user->userProfile($req, $res, $args); 
    });
  }
}
