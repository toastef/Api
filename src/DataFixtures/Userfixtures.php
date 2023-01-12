<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Userfixtures extends Fixture
{
    private $hasher;
    public function __construct(UserPasswordHasherInterface  $hasher){
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
       for ($i = 0; $i <= 30; $i++){
            $user = new User;
            $user->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setEmail($user->getFirstName().''.''.$user->getLastName().'"@gmail.com')
                ->setRoles(['ROLE_USER'])
                ->setPassword($this->hasher->hashPassword( $user, "password"));
            $manager->persist($user);
       }
        $manager->flush();


        $user = new User();
        $user   ->setFirstName('John')
            ->setLastName('Doe')
            ->setEmail('john.doe@gmail.com')
            ->setPassword($this->hasher->hashPassword($user, 'password'))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();
    }


}
