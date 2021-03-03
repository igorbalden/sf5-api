<?php 
namespace App\Tests\Controller;

use App\Authentication\JwtBuilder;
use App\Domain\Users\Registration;
use App\Validation\UsersValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase {

  private $user_validator;
  private $jwt_auth;

  public function __construct(
    UsersValidator $user_validator, 
    JwtBuilder $jwt_builder) 
  {
    $this->user_validator = $user_validator;
    $this->jwt_auth = $jwt_builder->getJwtAuth();
  }
  /*
  public function register_user(Request $req, Registration $registration): Response {
    $errors = $this->user_validator->register($req);
    if ($errors !== '[]') {
      return new Response(json_encode(['errors' => $errors]), 201);
    }
    $msg = $registration->register($req);
    return new Response($msg, 201);
  }
  */
}