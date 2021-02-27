<?php 

namespace App\Controller;

use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ErrorController extends AbstractController {

  public function show(
    Request $req, 
    FlattenException $exception, 
    Logger $logger): Response 
  {
    return new Response( 
      json_encode($exception->getMessage()), 
      $exception->getCode() ?: 500
    );
  }

}