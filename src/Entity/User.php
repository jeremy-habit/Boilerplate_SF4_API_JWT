<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=25, unique=true)
   */
  private $username;

  /**
   * @ORM\Column(type="string", length=500)
   */
  private $password;

  /**
   * @ORM\Column(type="string", unique=true)
   */
  private $email;

  /**
   * @ORM\Column(name="is_active", type="boolean")
   */
  private $isActive;

  /**
   * @ORM\Column(type="array", length=500)
   */
  private $roles;

  public function __construct($username)
  {
    $this->isActive = true;
    $this->username = $username;
    $this->addRoles("ROLE_USER");
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getSalt()
  {
    return null;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function getRoles()
  {
    return $this->roles;
  }

  public function eraseCredentials()
  {
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id): void
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * @param mixed $email
   */
  public function setEmail($email): void
  {
    $this->email = $email;
  }


  /**
   * @return mixed
   */
  public function getisActive()
  {
    return $this->isActive;
  }

  /**
   * @param mixed $isActive
   */
  public function setIsActive($isActive): void
  {
    $this->isActive = $isActive;
  }

  /**
   * @param mixed $roles
   */
  public function setRoles($roles): void
  {
    $this->roles = $roles;
  }

  public function addRoles(String $role): void
  {
    $this->roles[] = $role;
  }

}
