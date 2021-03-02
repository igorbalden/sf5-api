<?php 

namespace App\Authentication;

use App\Entity\Users;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;

class CookieJwt implements JwtAuth {

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
    $token = JWT::encode($payload, $_ENV['APP_SECRET'], 'HS256');
    $this->header_token = null;
    $this->cookie_token = Cookie::create('toksign')
      ->withValue($token)
      ->withExpires(strtotime("+1 day"))
      ->withPath('/')
      // ->withDomain($_ENV['COOKIE_DOMAIN'])
      ->withSecure(true)
      ->withHttpOnly(true)
      ->withSameSite('None');
  }

  public function decodeJwt(Request $req) {
    $token = $req->cookies->get('toksign');
    if (! $token) {
      throw new \UnexpectedValueException('Request-Token error.', 403);
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