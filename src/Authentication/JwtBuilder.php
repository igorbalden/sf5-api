<?php 

namespace App\Authentication;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class JwtBuilder {

  private $jwt_channel;

  public function __construct(ParameterBagInterface $params) {
    $this->jwt_channel = $params->get('jwt_channel');
  }

  public function getJwtAuth(): JwtAuth {
    $class_name = '';
    if (strtolower($this->jwt_channel) === 'header') {
      $class_name = 'HeaderJwt';
    }
    if (strtolower($this->jwt_channel) === 'header-cookie') {
      $class_name = 'HeaderCookieJwt';
    }
    if (strtolower($this->jwt_channel) === 'cookie') {
      $class_name = 'CookieJwt';
    }
    if ($class_name === '') {
      throw new \RuntimeException('Jwt channel error.');
    }
    $class_name = __NAMESPACE__. '\\'. $class_name;
    return new $class_name;
  }

}