<?php 

namespace App\Domain\Users;

use App\Repository\UsersRepository;

abstract class BaseUsers {

  protected $users_repo;

  public function __construct(UsersRepository $users_repo) {
    $this->users_repo = $users_repo;
  }
  
}