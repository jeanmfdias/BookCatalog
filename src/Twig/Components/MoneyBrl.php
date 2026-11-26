<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class MoneyBrl
{
    public float $value = 0.0;

    public function getValueFormatted(): string
    {
        return 'R$ ' . number_format($this->value, 2, ',', '.');
    }
}
