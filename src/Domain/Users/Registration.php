<?php 

namespace App\Domain\Users;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;

class Registration extends BaseUsers {

  public function index() {
    return false;
  }

  public function register(Request $req): string {
    $user = new Users();
    $input_obj = json_decode($req->getContent());
    $user->setName(trim($input_obj->name));
    $user->setEmail(trim($input_obj->email));
    $user->setPassword(password_hash(trim($input_obj->password), 
        PASSWORD_DEFAULT));
    $user_email = $this->users_repo->store($user);
    if (!$user_email) {
      return 'Error creating user!';
    }
    return "New user created, with email $user_email.";
  }
  
}
