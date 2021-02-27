<?php 

namespace App\Controller;

use App\Authentication\JwtAuth;
use App\Domain\Users\ListUsers;
use App\Domain\Users\Registration;
use App\Validation\UsersValidator;
use App\Domain\Users\Authentication;
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
    $msg = $authentication->login($req);
    return new Response($msg, 200);
  }

  public function users(Request $req, ListUsers $listUsers): Response {
    $jwt_user = JwtAuth::getJwtContent($req);
    $msg = $listUsers->listUsers($req);
    return new Response($msg, 200);
  }

}