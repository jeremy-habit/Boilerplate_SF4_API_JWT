<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MainController extends Controller
{

  public function register(Request $request, UserPasswordEncoderInterface $encoder)
  {
    $em = $this->getDoctrine()->getManager();
    $username = $request->get('username');
    $password = $request->get('password');
    $email = $request->get('email');
    $user = new User($username);
    $user->setPassword($encoder->encodePassword($user, $password));
    $user->setEmail($email);
    $em->persist($user);
    $em->flush();
    return new Response(sprintf('User %s successfully created', $user->getUsername()));
  }
}