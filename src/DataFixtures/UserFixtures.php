<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture /* implements DependentFixtureInterface */
{

  /* public const USER_REF_1 = "user_ref_1";*/

  private $encoder;

  public function __construct(UserPasswordEncoderInterface $encoder)
  {
    $this->encoder = $encoder;
  }

  public function load(ObjectManager $manager)
  {

    // Configure the languages of data
    $faker = Faker\Factory::create('fr_FR');

    // creation of 2 users
    for ($i = 0; $i < 2; $i++) {
      $user = new User();
      $user->setIsActive(true);
      $user->addRole("ROLE_USER");
      $user->setLastName($faker->lastName);
      $user->setFirstName($faker->firstName);
      $user->setUsername($faker->userName);
      $user->setEmail($faker->email);
      $user->setPassword($this->encoder->encodePassword($user, 'password'));
      $manager->persist($user);
      /*$this->addReference(self::USER_REF_1, $user);*/
    }

    $manager->flush();
  }
}