<?php 

namespace App\Validation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Rules;

class UsersValidator extends BaseValidator {

  public function register(Request $req): string {
    $input_arr = (array) json_decode($req->getContent());
    $input = array_map('trim', $input_arr);
    $constraint = new Rules\Collection([
      'name' => [
          new Rules\NotBlank(),
          new Rules\Length(['min' => 1])
        ],
      'email' => [
          new Rules\NotBlank(),
          new Rules\Email(),
          // unique
        ],
      'password' => [
          new Rules\NotBlank(),
          new Rules\Length(['min' => 2]),
          // add rule no spaces allowed in password
        ],
    ]);
    $errors = $this->validator->validate($input, $constraint);
    return $this->get_errors($errors);
  }

}
