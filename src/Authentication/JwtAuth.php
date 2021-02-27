<?php 

namespace App\Authentication;

use App\Entity\Users;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtAuth {

  static public function getJwt(Users $user): string {
    $payload = [
      'uid' => $user->getId(),
      'email' => $user->getEmail(),
      "iss" => "http://192.168.99.102:8000",
      'iat' => time(),
      'exp' => time() + (1 * 30),  // * 24 * 60 seconds
    ];
    return JWT::encode($payload, $_ENV['APP_SECRET'], 'HS256');
  }
  
  static public function getJwtContent(Request $req) {
    $auth = $req->headers->get('authorization');
    if (! $auth) {
      throw new \UnexpectedValueException('Header error.', 403);
    }
    $token = explode(' ', $auth)[1];
    if (! $token) {
      throw new \UnexpectedValueException('Token header error.', 403);
    }
    JWT::$leeway = 10; // $leeway in seconds
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