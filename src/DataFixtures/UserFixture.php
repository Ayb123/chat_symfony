<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserFixture extends Fixture
{
    private $password;

    
    public function load(ObjectManager $manager): void
    {
         $user=new User();
         $user->setUsername("Ayoub_lk");
       
         $user->setEmail("ayoublekhal@gmail.com");
         $user->setPassword("test");
        $manager->persist($user);
        $manager->flush();
    }
}
