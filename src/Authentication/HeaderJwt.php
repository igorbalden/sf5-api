<?php 

namespace App\Authentication;

use App\Entity\Users;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;

class HeaderJwt implements JwtAuth {

  public $header_token;
  public $cookie_token;

  public function getJwt(Users $user): void {
    $payload = [
      'uid' => $user->getId(),
      'uemail' => $user->getEmail(),
      // "iss" => "http://192.168.99.102:8000",
      'iat' => time(),
      'exp' => time() + (1 * 24 * 60 * 60),   // 1 day
    ];
    $this->header_token = 
      'Bearer '. JWT::encode($payload, $_ENV['APP_SECRET'], 'HS256');
    $this->cookie_token = null;
  }
  
  public function decodeJwt(Request $req) {
    $auth = $req->headers->get('authorization');
    if (! $auth) {
      throw new \UnexpectedValueException('Header error.', 403);
    }
    $token = explode(' ', $auth)[1];
    if (! $token) {
      throw new \UnexpectedValueException('Request Token error.', 403);
    }

    JWT::$leeway = 2 * 60; // $leeway in seconds
    try {
      $decoded = JWT::decode($token, $_ENV['APP_SECRET'], array('HS256'));
    } catch (\Firebase\JWT\SignatureInvalidException $exception) {
      throw new \Exception('Invalid Token.', 403);
    } catch (\Firebase\JWT\BeforeValidException $exception) {
      throw new \Exception('Token not valid, yet.', 403);
    } catch (\Firebase\JWT\ExpiredException $exception) {
      throw new \Exception('Token expired.', 403);
    } catch (\Exception $exception) {
      throw new \Exception('Token error.', 403);
    }
    return $decoded;
  }

}