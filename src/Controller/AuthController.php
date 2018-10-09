<?php

namespace App\Controller;

use App\Services\AuthManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
    return new JsonResponse(["message" => "User added successfully", "last_insert_id" => $user->getId()], Response::HTTP_OK);
  }

  /**
   * @Rest\View()
   * @Rest\Get("/logged_confirm")
   * @return JsonResponse
   */
  public function loggedConfirm()
  {
    return new JsonResponse(
      ["message" => sprintf('Logged in as %s', $this->getUser()), "user" => $this->getUser()],
      Response::HTTP_OK
    );
  }

}