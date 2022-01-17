<?php 

namespace App\Controller;

use App\Authentication\JwtAuth;
use App\Domain\Users\ListUsers;
use App\Authentication\JwtBuilder;
use App\Domain\Users\Registration;
use App\Validation\UsersValidator;
use App\Domain\Users\Authentication;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController {

  private $user_validator;
  private $jwt_auth;

  public function __construct(
    UsersValidator $user_validator, 
    JwtBuilder $jwt_builder) 
  {
    $this->user_validator = $user_validator;
    $this->jwt_auth = $jwt_builder->getJwtAuth();
  }

  public function register(Request $req, Registration $registration): Response {
    $errors = $this->user_validator->register($req);
    if ($errors !== '[]') {
      return new Response(json_encode(['error' => $errors]), 400);
    }
    $msg = $registration->register($req);
    return new Response($msg, 201);
  }

  public function login(Request $req, Authentication $auth): Response {
    $res = new Response();    
    $jwt = $auth->login($req);
    $cont_arr = [];
    if (is_null($jwt)) {
      $cont_arr = ['error' => 'Email or password incorrect.'];
      $res->setContent(json_encode($cont_arr));
      $res->setStatusCode(403);
      return $res;
    } 
    if ($jwt->header_token) {
      $cont_arr = ['Authorization' => $jwt->header_token];
    } 
    if ($jwt->cookie_token) {
      $res->headers->setCookie($jwt->cookie_token);
    }
    $res->setContent(json_encode($cont_arr));
    $res->setStatusCode(200);
    return $res;
  }

  public function users(Request $req, ListUsers $listUsers): Response {
    $jwt_user = $this->jwt_auth->decodeJwt($req);
    $msg = $listUsers->listUsers($req);
    return new Response($msg, 200);
  }

}
