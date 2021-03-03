<?php 

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

  /** @test */
  public function check_if_phpunit_works(): void {
    $client = $this->createClient();
    $client->request('GET', '/');
    
    $this->assertEquals('200', $client->getResponse()->getStatusCode());
    $this->assertEquals('Symfony Api', $client->getResponse()->getContent());
  }

}