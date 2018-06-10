<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;/*
use Symfony\Component\Validator\ConstraintViolationListInterface;*/

abstract class AbstractController
{
  private $tokenStorage;
  private $em;

  public function __construct(EntityManagerInterface $em, TokenStorageInterface $tokenStorage)
  {
    $this->tokenStorage = $tokenStorage;
    $this->em = $em;
  }

  protected function getUser()
  {
    $token = $this->tokenStorage->getToken();
    if ($token instanceof TokenInterface) {
      /** @var User $user */
      $user = $token->getUser();
      return $user;
    } else {
      return null;
    }
  }

  protected function getManager()
  {
    return $this->em;
  }
/*
  protected function sendViolationErrors(ConstraintViolationListInterface $validationErrors, int $errorCode)
  {
    $result["code"] = $errorCode;
    foreach ($validationErrors as $key => $validationError) {
      $result["message"][$key][] = $validationError->getPropertyPath();
      $result["message"][$key][] = $validationError->getMessage();
    }
    return $result;
  }*/

  protected function sendJsonResponse($data, $code = Response::HTTP_OK)
  {
    $result["code"] = $code;
    $result["message"] = $data;
    return $result;
  }
}