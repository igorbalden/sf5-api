<?php 

namespace App\Domain\Users;

use App\Entity\Users;
use App\Authentication\JwtAuth;
use Symfony\Component\HttpFoundation\Request;

class Authentication extends BaseUsers {

  public function index() {
    return false;
  }

  public function login(Request $req): array {
    $user = new Users();
    $input_obj = json_decode($req->getContent());
    $user->setEmail($input_obj->email);
    $user->setPassword($input_obj->password);
    $new_user = $this->users_repo->authenticate($user);
    if ($new_user) {
      $token = JwtAuth::getJwt($new_user);
      return ['Authorization' => $token,];
    } else {
      return ['error' => 'Email or password incorrect.'];
    }
  }

}
