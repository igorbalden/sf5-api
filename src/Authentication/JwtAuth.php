<?php 

namespace App\Authentication;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;

interface JwtAuth {

  public function getJwt(Users $user);

  public function decodeJwt(Request $req);

}