<?php

namespace App\Controller;

use App\Services\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends AbstractController
{
  /**
   * @Rest\Post("/register")
   * @ParamConverter("user", converter="fos_rest.request_body")
   * @param User $user
   * @param UserManager $userManager
   * @return JsonResponse
   */
  public function register(User $user, UserManager $userManager)
  {
    $userManager->create($user);
    return new JsonResponse();
  }

  public function api()
  {
    return new JsonResponse(sprintf('Logged in as %s', $this->getUser()->getUsername()));
  }

}