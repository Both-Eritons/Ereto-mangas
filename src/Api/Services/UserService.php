<?php

namespace Ereto\Api\Services;

use Ereto\Api\Models\UserModel;
use Ereto\Api\Repositories\UserRepository;
use Ereto\Utils\HttpJson;
use Exception;

class UserService {

  private $userRepo;
  function __construct(UserRepository $userRepo) {
    $this->userRepo = $userRepo;
  }

  function createUser(string $username, string $password) {
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
