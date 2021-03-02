<?php 

namespace App\Domain\Users;

use App\Entity\Users;
use App\Authentication\JwtAuth;
use App\Authentication\JwtBuilder;
use Symfony\Component\HttpFoundation\Request;

class Authentication extends BaseUsers {

  public function index() {
    return false;
  }

  public function login(Request $req): ?JwtAuth {
    $user = new Users();
    $input_obj = json_decode($req->getContent());
    $user->setEmail($input_obj->email);
    $user->setPassword($input_obj->password);
    $repo_user = $this->users_repo->authenticate($user);
    if (! $repo_user) {
      return null;
    } else {
      $jwt_auth = $this->jwt_builder->getJwtAuth();
      $jwt_auth->getJwt($repo_user);
      return $jwt_auth;
    }
  }

}
