<?php

namespace App\Twig\Components\Admin;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class ButtonNewEntity
{
    public string $name;
    public string $action;
    public string $icon = "material-symbols:add";
    public int $size = 24;
    public int $width = 150;
}
