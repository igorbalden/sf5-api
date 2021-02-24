<?php 

namespace App\Tests\Domain\Users;

use App\Domain\Users\Registration;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationTest extends WebTestCase {

  /** 
   * @test 
   * @dataProvider provideInputs
   */
  public function register_user($inp, $exp) {
    $client = self::createClient();
    self::bootKernel();
    $client->xmlHttpRequest('post', '/register', [], [],
      ['CONTENT_TYPE' => 'application/json',],
      $inp
    );
    // $logger = self::$container->get('logger');
    // $logger->INFO('logger::--');
      $conn = self::$container->get('doctrine')->getManager()->getConnection();
      $stmt = $conn->prepare("DELETE FROM users WHERE id > 0");
      $stmt->execute();
    $users_repo = self::$container->get(UsersRepository::class);
    $registrator = new Registration($users_repo);
      $stmt = $conn->prepare("DELETE FROM users WHERE id > 0");
      $stmt->execute();
    $result = $registrator->register($client->getRequest());
    // $logger->INFO('registrator::--'. serialize($registrator));
    $this->assertEquals($exp, $result);
  }

  public function provideInputs() {
    return [
      ['{"name":"k","email":"okl@okl.okl","password":"12"}', 
        'New user created, with email okl@okl.okl.'],
    ];
  }

  // protected function tearDown(): void {
  //   $conn = $this->_em->getConnection();
  //   $stmt = $conn->prepare("SELECT name FROM users WHERE id= :id");
  //   $stmt->execute(['id' => $id]);
  // }

}
