<?php

namespace App\Twig\Components\Admin\Form;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class ButtonRemove
{
    public string $name = "Supprimer";
    public string $action;
    public array $parameters = [];
    public int $width = 110;
    public string $icon = "fluent:delete-32-filled";
    public int $size = 24;
}
