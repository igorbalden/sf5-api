<?php 

namespace App\Domain\Users;

use App\Authentication\JwtBuilder;
use App\Repository\UsersRepository;

abstract class BaseUsers {

  protected $users_repo;
  protected $jwt_builder;

  public function __construct(
    UsersRepository $users_repo,
    JwtBuilder $jwt_builder) 
  {
    $this->users_repo = $users_repo;
    $this->jwt_builder = $jwt_builder;
  }
  
}