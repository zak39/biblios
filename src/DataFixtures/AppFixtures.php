<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\AuthorFactory;
use App\Factory\BookFactory;
use App\Factory\CommentFactory;
use App\Factory\EditorFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }
    
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setUsername('admin')
            ->setLastname('admin')
            ->setFirstname('admin')
            ->setEmail('admin@biblios.fr')
            ->setPassword(
                $this->passwordHasher->hashPassword($user, 'ribcage-comprised-filing')
            )
            ->setRoles(['ROLE_ADMIN'])
        ;
        $manager->persist($user);

        AuthorFactory::createMany(50);
        EditorFactory::createMany(20);
        UserFactory::createMany(10);
        BookFactory::createMany(100);
        CommentFactory::createMany(200);
    }
}
