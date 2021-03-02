<?php 

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

  /** @test */
  public function check_if_phpunit_works() {
    $client = $this->createClient();
    $client->request('GET', '/');
    
    $this->assertEquals('200', $client->getResponse()->getStatusCode());
    $this->assertEquals('Symfony Api', $client->getResponse()->getContent());
  }

}