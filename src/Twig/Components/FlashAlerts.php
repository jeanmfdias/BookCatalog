<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class FlashAlerts
{
    public string $type = 'info';

    public ?string $message = '';

    public bool $hasBtnClose = true;

    public function getThemeClass(): string
    {
        return match ($this->type) {
            'error', 'danger' => 'theme-danger',
            'warning' => 'theme-warning',
            'success' => 'theme-success',
            default => 'theme-info'
        };
    }
}
