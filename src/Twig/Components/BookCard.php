<?php

namespace App\Twig\Components;

use Doctrine\Common\Collections\Collection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class BookCard
{
    public int $id;
    public string $title;
    public string $cover;
    public Collection $authors;
}
