<?php

namespace Ereto\Api\Services;

use Ereto\Api\Repositories\UserRepository;
use Ereto\Utils\HttpJson;

class UserService {

  private $userRepo;
  function __construct(UserRepository $userRepo) {
    $this->userRepo = $userRepo;
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
