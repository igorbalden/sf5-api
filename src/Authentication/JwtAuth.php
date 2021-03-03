<?php 

namespace App\Authentication;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;

abstract class JwtAuth {

  public $header_token;
  public $cookie_token;

  abstract public function makeJwt(Users $user): void;

  abstract public function decodeJwt(Request $req): \stdClass;

}