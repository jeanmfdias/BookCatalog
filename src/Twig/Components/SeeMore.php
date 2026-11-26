<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class SeeMore
{
    public ?string $text;

    public function getTextWithSeeMore(): string
    {
        return mb_substr($this->text, 0, 15) . '...';
    }
}
