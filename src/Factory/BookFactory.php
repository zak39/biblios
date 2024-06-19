<?php

namespace App\Factory;

use App\Entity\Book;
use App\Enum\BookStatus;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Book>
 */
final class BookFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Book::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'cover' => self::faker()->imageUrl(330, 500, 'couverture', true),
            'createdBy' => UserFactory::random(),
            'editedAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'editor' => EditorFactory::random(),
            'authors' => AuthorFactory::randomSet(self::faker()->numberBetween(1, 2)),
            'isbn' => self::faker()->isbn13(),
            'pageNumber' => self::faker()->randomNumber(),
            'plot' => self::faker()->text(),
            'status' => self::faker()->randomElement(BookStatus::cases()),
            'title' => self::faker()->unique()->sentence(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Book $book): void {})
        ;
    }
}
