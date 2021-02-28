<?php 

namespace App\Controller;

use App\Authentication\JwtAuth;
use App\Domain\Users\ListUsers;
use App\Domain\Users\Registration;
use App\Validation\UsersValidator;
use App\Domain\Users\Authentication;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController {

  private $user_validator;

  public function __construct(UsersValidator $user_validator) {
    $this->user_validator = $user_validator;
  }

  public function register(Request $req, Registration $registration): Response {
    $errors = $this->user_validator->register($req);
    if ($errors !== '[]') {
      return new Response(json_encode(['errors' => $errors]), 200);
    }
    $msg = $registration->register($req);
    return new Response($msg, 201);
  }

  public function login(Request $req, Authentication $authentication): Response {
    $res = new Response();
    $auth_arr = $authentication->login($req);
    if (array_key_exists('error', $auth_arr)) {
      $msg = json_encode($auth_arr);
    } else {
      $msg = json_encode(['Authorization' => $auth_arr['Authorization']]);
    }
    $res->setContent($msg);
    $res->setStatusCode(200);
    return $res;
  }

  public function users(Request $req, ListUsers $listUsers): Response {
    $jwt_user = JwtAuth::decodeJwt($req);
    $msg = $listUsers->listUsers($req);
    return new Response($msg, 200);
  }

}