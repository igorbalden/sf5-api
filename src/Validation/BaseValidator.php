<?php 

namespace App\Validation;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class BaseValidator {

  protected $validator;

  public function __construct() {
    $this->validator = Validation::createValidator();
  }

  protected function get_errors(ConstraintViolationListInterface $err): string {
    $errors_arr = array();
    foreach ($err as $e) {
      $key = trim($e->getPropertyPath(), '[,]');
      $errors_arr[$key] = $e->getMessage();
    }
    return json_encode($errors_arr);
  }

}
