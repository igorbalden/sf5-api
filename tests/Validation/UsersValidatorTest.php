<?php 

namespace App\Tests\Validation;

use App\Validation\UsersValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersValidatorTest extends WebTestCase {

  /** 
   * @test 
   * @dataProvider provideInputs
   */
  public function validation_in_register($inp, $exp) {
    $client = self::createClient();
    $client->xmlHttpRequest('post', '/register', [], [],
      ['CONTENT_TYPE' => 'application/json',],
      $inp
    );
    $validator = new UsersValidator();
    $errors = $validator->register($client->getRequest());
    $this->assertStringContainsString($exp, (string) $errors);
  }

  public function provideInputs() {
    return [
      ['{"name":"","email":"","password":"1"}', 'name'],
      ['{"name":"","email":"","password":"1"}', 'email'],
      ['{"name":"","email":"","password":"1"}', 'password'],
      ['{"name":"ko","email":"okl","password":"12"}', 'email'],
      ['{"name":"","email":"okl@okl.okl","password":"12"}', 'name'],
      ['{"name":"ko","email":"okl@okl.okl","password":""}', 'password'],
      ['{"name":"ko","email":"okl@okl.okl","password":"1"}', 'password'],
    ];
  }
  
}
