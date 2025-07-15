<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Components;

use RainbowRush\KaraTemplater\Enum\Component;

final class Mixin extends AbstractComponent
{
    public function __construct()
    {
        $this->component = Component::MIXIN;
    }
}
