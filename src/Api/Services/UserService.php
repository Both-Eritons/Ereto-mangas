<?php

namespace Ereto\Api\Services;

use Ereto\Api\Models\UserModel;
use Ereto\Api\Repositories\UserRepository;
use Ereto\Constants\UserConstant as UC;
use Exception;

class UserService {

  private $userRepo;
  function __construct(UserRepository $userRepo) {
    $this->userRepo = $userRepo;
  }

  function createUser($username, $password) {
    if(is_null($username) || is_null($password)) {
      throw new Exception(UC::$errors["BODY"], 400);
    }

    $user = $this->userRepo->findUserByUsername($username);

    if($user) {
      throw new Exception(UC::$errors["EXISTS"], 409);
    }

    if(strlen($username) < 4 || strlen($username) > 10) {
      throw new Exception(UC::$errors["USERNAME_BETWEEN"], 400);
    }

    if(strlen($password) < 6 || strlen($password) > 24) {
      throw new Exception(UC::$errors["PASSWORD_BETWEEN"], 400);
    }

    $userM = new UserModel(null, $username, null, $password);

    return $this->userRepo->createUser($userM);
  
  }

  function UserExist($id): ? UserModel {
    return $this->userRepo->findUser($id);
  }

}
