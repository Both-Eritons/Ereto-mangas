<?php

namespace Ereto\Api\Services;

use Ereto\Api\Models\UserModel;
use Ereto\Api\Repositories\UserRepository;
use Ereto\Utils\HttpJson;

class UserService {

  private $userRepo;
  function __construct(UserRepository $userRepo) {
    $this->userRepo = $userRepo;
  }

  function createUser(string $username, string $password) {
    $user = $this->userRepo->findUserByUsername($username);

    if($user) {
      return HttpJson::Json("usuario ja existe!", 303);
    }

    if(strlen($username) < 4 || strlen($username) > 10) {

      return HttpJson::Json("usuario precisa ter entre 4-10!", 400);

    }
    if(strlen($password) < 4 || strlen($password) > 10) {

      return HttpJson::Json("senha precisa ter entre 4-10!", 400);

    }

    $userM = new UserModel(null, $username, null, $password);

    $user = $this->userRepo->createUser($userM);

    HttpJson::Json("usuario criado", 202);
  
  }

  function UserExist($id) {
    $user = $this->userRepo->findUser($id);
    if($user) {

      $arr = array(
        "id" => $user->getUserId(),
        "username" => $user->getUsername(),
        "password" => $user->getPassword(),
        "logo" => $user->getLogo()
      );

      return HttpJson::Json("usuario encontrado", 200, $arr);
      
    }
    
    HttpJson::Json("usuario nao encontrado", 404, null);
  }

}
