<?php

namespace App\Controller;

use App\Services\AuthManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends AbstractController
{
  /**
   * @Rest\View()
   * @Rest\Post("/register")
   * @ParamConverter("user", converter="fos_rest.request_body")
   * @param User $user
   * @param AuthManager $auth
   * @return JsonResponse
   * @throws \Exception
   */
  public function register(User $user, AuthManager $auth)
  {
    $auth->register($user);
    return $this->sendJsonResponse(["message" => "User added successfully", "last_insert_id" => $user->getId()]);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api")
   * @return JsonResponse
   */
  public function loggedConfirm()
  {
    return $this->sendJsonResponse(["message" => sprintf('Logged in as %s', $this->getUser()), "user" => $this->getUser()]);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/api/cosmos")
   * @return JsonResponse
   */
  public function cosmos()
  {
    return $this->sendJsonResponse(["message" => "humm ?"]);
  }

}