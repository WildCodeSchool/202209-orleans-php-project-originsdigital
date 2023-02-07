<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $contributor = new User();
        $contributor->setEmail('user@mail.com');
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $hashedPassword = $this->passwordHasher->hashPassword($contributor, 'userpassword');
        $contributor->setPassword($hashedPassword);
        $contributor->setUserName('johndoe');
        $contributor->setFirstName('John');
        $contributor->setLastName('Doe');
        $manager->persist($contributor);

        $contributor = new User();
        $contributor->setEmail('user_2@mail.com');
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $hashedPassword = $this->passwordHasher->hashPassword($contributor, 'user-2password');
        $contributor->setPassword($hashedPassword);
        $contributor->setUserName('emily-in-paris');
        $contributor->setFirstName('Emily');
        $contributor->setLastName('Cooper');
        $manager->persist($contributor);

        $contributor = new User();
        $contributor->setEmail('user_3@mail.com');
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $hashedPassword = $this->passwordHasher->hashPassword($contributor, 'user-3password');
        $contributor->setPassword($hashedPassword);
        $contributor->setUserName('kiki45');
        $contributor->setFirstName('Mark');
        $contributor->setLastName('Zuzu');
        $manager->persist($contributor);

        $contributor = new User();
        $contributor->setEmail('user-4@mail.com');
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $hashedPassword = $this->passwordHasher->hashPassword($contributor, 'user-4password');
        $contributor->setPassword($hashedPassword);
        $contributor->setUserName('sblondeau');
        $contributor->setFirstName('Sylvain');
        $contributor->setLastName('Blondeau');
        $manager->persist($contributor);

        $contributor = new User();
        $contributor->setEmail('user-5@mail.com');
        $contributor->setRoles(['ROLE_CONTRIBUTOR']);
        $hashedPassword = $this->passwordHasher->hashPassword($contributor, 'user-5password');
        $contributor->setPassword($hashedPassword);
        $contributor->setUserName('macrohard');
        $contributor->setFirstName('Billy');
        $contributor->setLastName('Laporte');
        $manager->persist($contributor);

        $admin = new User();
        $admin->setEmail('admin@zesport.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'adminpassword');
        $admin->setPassword($hashedPassword);
        $admin->setUserName('alansmith');
        $admin->setFirstName('Alan');
        $admin->setLastName('Smith');
        $manager->persist($admin);

        $manager->flush();
    }
}
