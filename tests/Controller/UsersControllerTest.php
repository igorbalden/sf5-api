<?php 
namespace App\Tests\Controller;

use App\Domain\Users\Registration;
use App\Validation\UsersValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase {
/*
  private $user_validator;

  public function __construct(UsersValidator $user_validator) {
    $this->user_validator = $user_validator;
  }

  public function register(Request $req, Register $register): Response {
    $errors = $this->user_validator->register($req);
    if (count($errors) > 0) {
      return new Response($this->user_validator->get_errors($errors), 200);
    }
    $msg = $registration->register($req);
    return new Response($msg, 200);
  }
*/
}