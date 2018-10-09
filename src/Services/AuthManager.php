<?php

namespace App\Services;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthManager
{

  private $em;
  private $mail;
  private $encoder;
  private $requestStack;

  /**
   * UserManager constructor.
   * @param EntityManagerInterface $em
   * @param UserPasswordEncoderInterface $encoder
   * @param Mail $mail
   * @param RequestStack $requestStack
   */
  public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, Mail $mail, RequestStack $requestStack)
  {
    $this->encoder = $encoder;
    $this->em = $em;
    $this->mail = $mail;
    $this->requestStack = $requestStack;
  }

  /**
   * @param User $user
   * @return User
   * @throws \Exception
   */
  public function register(User $user)
  {
    try {
      $user->setIsActive(true);
      $user->addRole("ROLE_USER");
      $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
      $this->em->persist($user);
      $this->em->flush();
      return $user;
    } catch (\Exception $exception) {
      throw $exception;
    }
  }
}