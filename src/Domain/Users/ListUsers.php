<?php 

namespace App\Domain\Users;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;

class ListUsers extends BaseUsers {

  public function listUsers(Request $req): string {
    $users = $this->users_repo->getAll();
    if ($users) {
      return json_encode($users);
    } else {
      return json_encode(['error' => 'Error getting users!']);
    }
  }
  
}
