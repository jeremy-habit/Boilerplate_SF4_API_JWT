<?php

namespace App\Services;

use Twig_Environment;

class Mail
{
  private $mailer;
  private $twig;

  public function __construct(\Swift_Mailer $mailer, Twig_Environment $twig)
  {
    $this->mailer = $mailer;
    $this->twig = $twig;
  }

  public function makeMessage($subject, $from, $to, $body): void
  {
    $message = (new \Swift_Message($subject))
      ->setFrom($from)
      ->setTo($to)
      ->setBody($body, 'text/html');
    $this->mailer->send($message);
  }
}