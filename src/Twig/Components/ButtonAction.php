<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class ButtonAction
{
    public string $name;
    public string $action;
    public array $parameters = [];
    public string $type;
    public int $width = 150;
    public string $icon;
    public int $size = 24;
}
