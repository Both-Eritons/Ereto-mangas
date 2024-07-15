<?php

namespace Ereto\Api\Services;

use Ereto\Api\Models\UserModel;
use Ereto\Api\Repositories\UserRepository;
use Exception;

class UserService {

  private $userRepo;
  function __construct(UserRepository $userRepo) {
    $this->userRepo = $userRepo;
  }

  function createUser($username, $password) {
    if(is_null($username) || is_null($password)) {
      throw new Exception("body is wrong", 400);
    }

    $user = $this->userRepo->findUserByUsername($username);

    if($user) {
      throw new Exception("Username already exists!", 303);
    }

    if(strlen($username) < 4 || strlen($username) > 10) {
      throw new Exception("user needs to be between 4-10", 400);
    }

    if(strlen($password) < 6 || strlen($password) > 24) {
      throw new Exception("password needs to be between 6-24", 400);
    }

    $userM = new UserModel(null, $username, null, $password);

    return $this->userRepo->createUser($userM);
  
  }

  function UserExist($id): ? UserModel {
    return $this->userRepo->findUser($id);
  }

}
