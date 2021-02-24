<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Validation\UsersValidator;
use App\Domain\Users\Registration;

class UsersController extends AbstractController {

  private $user_validator;

  public function __construct(UsersValidator $user_validator) {
    $this->user_validator = $user_validator;
  }

  public function register(Request $req, Registration $registration): Response {
    $errors = $this->user_validator->register($req);
    if ($errors !== '[]') {
      return new Response($errors, 200);
    }
    $msg = $registration->register($req);
    return new Response($msg, 200);
  }

}