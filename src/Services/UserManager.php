<?php

namespace App\Services;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
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
   */
  public function create(User $user)
  {
    $user->__construct();
    /* $generatedPassword = $this->generatePassword();*/
    $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
    $this->em->persist($user);
    $this->em->flush();
    return $user;
  }

  /**
   * Generate random password
   * @return string
   */
  private function generatePassword()
  {
    try {
      return bin2hex(random_bytes(10));
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
}