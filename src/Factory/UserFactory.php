<?php

namespace App\Factory;

use App\Entity\User;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<User>
 */
final class UserFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public static function class(): string
    {
        return User::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        $roles = [
            'ROLE_AJOUT_DE_LIVRE',
            'ROLE_EDITION_DE_LIVRE',
            'ROLE_ADMIN'
        ];

        return [
            'email' => self::faker()->email(),
            'username' => self::faker()->userName(),
            'firstname' => Factory::create()->firstName(),
            'lastname' => Factory::create()->lastName(),
            'password' => 'password',
            'roles' => self::faker()->randomElements($roles),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(User $user): void {})
            ->afterInstantiate(function (User $user) {
                $user->setPassword($this->userPasswordHasher->hashPassword($user, $user->getPassword()));
            })
        ;
    }
}
